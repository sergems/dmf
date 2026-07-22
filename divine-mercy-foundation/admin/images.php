<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

$admin_title = 'Slider Images';
$pdo  = get_db();
$errors  = [];
$success = '';

// ── helpers ──────────────────────────────────────────────────
function slider_images_list(PDO $pdo): array {
    $raw = get_setting('slider_images', '');
    if (!$raw) return [];
    $arr = json_decode($raw, true);
    return is_array($arr) ? $arr : [];
}

function save_slider_images(PDO $pdo, array $list): void {
    $json = json_encode(array_values($list));
    if (DB_DRIVER === 'sqlite') {
        $pdo->prepare("INSERT OR REPLACE INTO settings (setting_key, setting_value) VALUES ('slider_images', ?)")->execute([$json]);
    } else {
        $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES ('slider_images', ?)
            ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value)")->execute([$json]);
    }
}

$upload_dir = dirname(__DIR__) . '/uploads/slider/';
if (!is_dir($upload_dir)) mkdir($upload_dir, 0775, true);

// ── DELETE ───────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_image'])) {
    if (!verify_csrf()) {
        $errors[] = 'Invalid request.';
    } else {
        $file = basename($_POST['delete_image']);
        $list = slider_images_list($pdo);
        $list = array_filter($list, fn($f) => basename($f) !== $file);
        save_slider_images($pdo, array_values($list));
        @unlink($upload_dir . $file);
        set_flash('success', 'Image deleted.');
        redirect('/admin/images.php');
    }
}

// ── REORDER (move up / move down) ────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['move_image'], $_POST['direction'])) {
    if (!verify_csrf()) {
        $errors[] = 'Invalid request.';
    } else {
        $list  = slider_images_list($pdo);
        $idx   = array_search($_POST['move_image'], $list);
        $dir   = $_POST['direction'] === 'up' ? -1 : 1;
        $swap  = $idx + $dir;
        if ($idx !== false && isset($list[$swap])) {
            [$list[$idx], $list[$swap]] = [$list[$swap], $list[$idx]];
            save_slider_images($pdo, $list);
        }
        redirect('/admin/images.php');
    }
}

// ── UPLOAD ───────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['slider_image'])) {
    if (!verify_csrf()) {
        $errors[] = 'Invalid request.';
    } else {
        $allowed = ['image/jpeg','image/jpg','image/png','image/webp','image/gif'];
        $max_bytes = 8 * 1024 * 1024; // 8 MB

        $uploads = $_FILES['slider_image'];
        // normalise to array form
        if (!is_array($uploads['name'])) {
            foreach ($uploads as $k => $v) $uploads[$k] = [$v];
        }

        $list = slider_images_list($pdo);

        foreach ($uploads['name'] as $i => $orig_name) {
            if ($uploads['error'][$i] === UPLOAD_ERR_NO_FILE) continue;
            if ($uploads['error'][$i] !== UPLOAD_ERR_OK) {
                $errors[] = "Upload error for \"$orig_name\".";
                continue;
            }
            if ($uploads['size'][$i] > $max_bytes) {
                $errors[] = "\"$orig_name\" exceeds 8 MB limit.";
                continue;
            }
            $mime = mime_content_type($uploads['tmp_name'][$i]);
            if (!in_array($mime, $allowed, true)) {
                $errors[] = "\"$orig_name\" is not an allowed image type.";
                continue;
            }
            $ext  = match($mime) {
                'image/jpeg','image/jpg' => 'jpg',
                'image/png'  => 'png',
                'image/webp' => 'webp',
                'image/gif'  => 'gif',
                default      => 'jpg',
            };
            $fname = 'slide-' . uniqid() . '.' . $ext;
            if (move_uploaded_file($uploads['tmp_name'][$i], $upload_dir . $fname)) {
                $list[] = 'uploads/slider/' . $fname;
            } else {
                $errors[] = "Could not save \"$orig_name\".";
            }
        }
        save_slider_images($pdo, $list);
        if (!$errors) {
            set_flash('success', 'Image(s) uploaded successfully.');
            redirect('/admin/images.php');
        }
    }
}

$slider_images = slider_images_list($pdo);
require_once __DIR__ . '/includes/header.php';
?>

<?= render_flash() ?>
<?php if ($errors): ?>
<div class="alert alert-error"><?php foreach ($errors as $e): ?><p><?= h($e) ?></p><?php endforeach; ?></div>
<?php endif; ?>

<p style="color:var(--muted);margin-bottom:1.5rem;">
    These images rotate automatically in the homepage hero slider. Upload up to 10 images for best performance. JPG, PNG, WebP, and GIF are supported (max 8 MB each).
</p>

<!-- Upload card -->
<div class="admin-card" style="margin-bottom:2rem;">
    <h3 class="settings-section-title" style="margin-bottom:1rem;">Upload Images</h3>
    <form method="post" action="/admin/images.php" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="img-drop-zone" id="drop-zone">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color:var(--muted)"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
            <p style="margin:.5rem 0 .25rem;font-weight:600;">Drag &amp; drop images here</p>
            <p style="font-size:.85rem;color:var(--muted);">or click to browse — JPG, PNG, WebP, GIF · max 8 MB each</p>
            <input type="file" name="slider_image[]" id="file-input" accept="image/*" multiple style="position:absolute;inset:0;opacity:0;cursor:pointer;">
        </div>
        <div id="preview-strip" style="display:none;margin-top:1rem;display:flex;flex-wrap:wrap;gap:.5rem;"></div>
        <div style="margin-top:1rem;">
            <button type="submit" class="btn btn-primary">Upload Selected Images</button>
        </div>
    </form>
</div>

<!-- Current slider images -->
<div class="admin-card">
    <h3 class="settings-section-title" style="margin-bottom:1rem;">
        Current Slider Images
        <span style="font-weight:400;font-size:.85rem;color:var(--muted);margin-left:.5rem;">(<?= count($slider_images) ?> image<?= count($slider_images) !== 1 ? 's' : '' ?>)</span>
    </h3>

    <?php if (empty($slider_images)): ?>
    <p style="color:var(--muted);padding:2rem 0;text-align:center;">No slider images yet. Upload some above.</p>
    <?php else: ?>
    <div class="slider-img-grid">
        <?php foreach ($slider_images as $i => $img): $fname = basename($img); ?>
        <div class="slider-img-card">
            <div class="slider-img-thumb">
                <img src="/<?= h($img) ?>" alt="Slide <?= $i + 1 ?>">
                <span class="slide-num"><?= $i + 1 ?></span>
            </div>
            <div class="slider-img-actions">
                <!-- Move up -->
                <form method="post" style="display:inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="move_image" value="<?= h($img) ?>">
                    <input type="hidden" name="direction" value="up">
                    <button type="submit" class="img-action-btn" title="Move left" <?= $i === 0 ? 'disabled' : '' ?>>◀</button>
                </form>
                <!-- Move down -->
                <form method="post" style="display:inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="move_image" value="<?= h($img) ?>">
                    <input type="hidden" name="direction" value="down">
                    <button type="submit" class="img-action-btn" title="Move right" <?= $i === count($slider_images) - 1 ? 'disabled' : '' ?>>▶</button>
                </form>
                <!-- Delete -->
                <form method="post" style="display:inline" onsubmit="return confirm('Delete this image from the slider?')">
                    <?= csrf_field() ?>
                    <input type="hidden" name="delete_image" value="<?= h($fname) ?>">
                    <button type="submit" class="img-action-btn img-action-btn--danger" title="Delete">✕</button>
                </form>
            </div>
            <p class="slider-img-name"><?= h($fname) ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<style>
.img-drop-zone {
    position: relative;
    border: 2px dashed var(--border);
    border-radius: var(--radius);
    padding: 2.5rem;
    text-align: center;
    transition: border-color .2s, background .2s;
    cursor: pointer;
}
.img-drop-zone.drag-over {
    border-color: var(--red);
    background: var(--red-light);
}
.slider-img-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 1rem;
}
.slider-img-card {
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    background: #fff;
}
.slider-img-thumb {
    position: relative;
    aspect-ratio: 16/9;
    background: #000;
    overflow: hidden;
}
.slider-img-thumb img {
    width: 100%; height: 100%;
    object-fit: cover;
    opacity: .9;
}
.slide-num {
    position: absolute;
    top: 6px; left: 8px;
    background: rgba(0,0,0,.6);
    color: #fff;
    font-size: .7rem;
    font-weight: 700;
    padding: 2px 7px;
    border-radius: 20px;
}
.slider-img-actions {
    display: flex;
    gap: .3rem;
    padding: .5rem .5rem .3rem;
    justify-content: center;
}
.img-action-btn {
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 6px;
    padding: .25rem .55rem;
    cursor: pointer;
    font-size: .8rem;
    transition: background .15s;
}
.img-action-btn:hover:not(:disabled) { background: var(--border); }
.img-action-btn:disabled { opacity: .35; cursor: default; }
.img-action-btn--danger { color: var(--danger); }
.img-action-btn--danger:hover:not(:disabled) { background: #fee2e2; }
.slider-img-name {
    font-size: .72rem;
    color: var(--muted);
    padding: 0 .5rem .5rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: center;
}
#preview-strip img {
    height: 70px;
    width: auto;
    border-radius: 6px;
    border: 2px solid var(--red);
    object-fit: cover;
}
</style>

<script>
const dz   = document.getElementById('drop-zone');
const inp  = document.getElementById('file-input');
const strip = document.getElementById('preview-strip');

function showPreviews(files) {
    strip.innerHTML = '';
    strip.style.display = files.length ? 'flex' : 'none';
    [...files].forEach(f => {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(f);
        strip.appendChild(img);
    });
}

inp.addEventListener('change', () => showPreviews(inp.files));

dz.addEventListener('dragover', e => { e.preventDefault(); dz.classList.add('drag-over'); });
dz.addEventListener('dragleave', () => dz.classList.remove('drag-over'));
dz.addEventListener('drop', e => {
    e.preventDefault();
    dz.classList.remove('drag-over');
    const dt = new DataTransfer();
    [...e.dataTransfer.files].filter(f => f.type.startsWith('image/')).forEach(f => dt.items.add(f));
    inp.files = dt.files;
    showPreviews(inp.files);
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
