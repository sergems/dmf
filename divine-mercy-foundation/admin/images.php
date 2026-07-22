<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

$admin_title = 'Slider Images';
$pdo  = get_db();
$errors = [];

// ── helpers ──────────────────────────────────────────────────
// Each slide is now: {image, title, subtitle}
// Backward compat: plain strings are promoted to objects.
function slider_list(PDO $pdo): array {
    $raw = get_setting('slider_images', '');
    if (!$raw) return [];
    $arr = json_decode($raw, true);
    if (!is_array($arr)) return [];
    return array_map(fn($s) => is_string($s)
        ? ['image'=>$s,'title'=>'','subtitle'=>'']
        : $s,
    $arr);
}

function save_slider(PDO $pdo, array $list): void {
    $json = json_encode(array_values($list), JSON_UNESCAPED_SLASHES);
    if (DB_DRIVER === 'sqlite') {
        $pdo->prepare("INSERT OR REPLACE INTO settings (setting_key, setting_value) VALUES ('slider_images',?)")->execute([$json]);
    } else {
        $pdo->prepare("INSERT INTO settings (setting_key,setting_value) VALUES (?,?)
            ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value)")->execute(['slider_images',$json]);
    }
}

$upload_dir = dirname(__DIR__) . '/uploads/slider/';
if (!is_dir($upload_dir)) mkdir($upload_dir, 0775, true);

// ── UPDATE SLIDE TEXT ─────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_text'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $idx  = (int)$_POST['slide_index'];
        $list = slider_list($pdo);
        if (isset($list[$idx])) {
            $list[$idx]['title']    = trim($_POST['slide_title']    ?? '');
            $list[$idx]['subtitle'] = trim($_POST['slide_subtitle'] ?? '');
            save_slider($pdo, $list);
            set_flash('success', 'Slide text updated.');
        }
        redirect('/admin/images.php');
    }
}

// ── DELETE ────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_image'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $file = basename($_POST['delete_image']);
        $list = array_values(array_filter(slider_list($pdo),
            fn($s) => basename($s['image']) !== $file));
        save_slider($pdo, $list);
        @unlink($upload_dir . $file);
        set_flash('success', 'Slide deleted.');
        redirect('/admin/images.php');
    }
}

// ── REORDER ───────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['move_image'], $_POST['direction'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $list = slider_list($pdo);
        $idx  = array_search($_POST['move_image'],
                    array_column($list, 'image'));
        $dir  = $_POST['direction'] === 'up' ? -1 : 1;
        $swap = $idx + $dir;
        if ($idx !== false && isset($list[$swap])) {
            [$list[$idx], $list[$swap]] = [$list[$swap], $list[$idx]];
            save_slider($pdo, $list);
        }
        redirect('/admin/images.php');
    }
}

// ── UPLOAD ────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['slider_image'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $allowed   = ['image/jpeg','image/jpg','image/png','image/webp','image/gif'];
        $max_bytes = 8 * 1024 * 1024;
        $uploads   = $_FILES['slider_image'];
        if (!is_array($uploads['name'])) {
            foreach ($uploads as $k => $v) $uploads[$k] = [$v];
        }
        $list = slider_list($pdo);
        foreach ($uploads['name'] as $i => $orig_name) {
            if ($uploads['error'][$i] === UPLOAD_ERR_NO_FILE) continue;
            if ($uploads['error'][$i] !== UPLOAD_ERR_OK) { $errors[] = "Upload error for \"$orig_name\"."; continue; }
            if ($uploads['size'][$i] > $max_bytes)        { $errors[] = "\"$orig_name\" exceeds 8 MB limit."; continue; }
            $mime = mime_content_type($uploads['tmp_name'][$i]);
            if (!in_array($mime, $allowed, true))          { $errors[] = "\"$orig_name\" is not an allowed image type."; continue; }
            $ext   = match($mime) { 'image/png'=>'png','image/webp'=>'webp','image/gif'=>'gif', default=>'jpg' };
            $fname = 'slide-' . uniqid() . '.' . $ext;
            if (move_uploaded_file($uploads['tmp_name'][$i], $upload_dir . $fname)) {
                $list[] = ['image'=>'uploads/slider/'.$fname,'title'=>'','subtitle'=>''];
            } else {
                $errors[] = "Could not save \"$orig_name\".";
            }
        }
        save_slider($pdo, $list);
        if (!$errors) { set_flash('success','Image(s) uploaded. Add titles below.'); redirect('/admin/images.php'); }
    }
}

$slides = slider_list($pdo);
require_once __DIR__ . '/includes/header.php';
?>

<?= render_flash() ?>
<?php if ($errors): ?>
<div class="alert alert-error"><?php foreach ($errors as $e): ?><p><?= h($e) ?></p><?php endforeach; ?></div>
<?php endif; ?>

<p style="color:var(--muted);margin-bottom:1.5rem;">
    Upload images for the homepage slider. Each slide can have its own title and subtitle — leave blank to hide text on that slide.
</p>

<!-- Upload -->
<div class="admin-card" style="margin-bottom:2rem;">
    <h3 class="settings-section-title" style="margin-bottom:1rem;">Upload New Slides</h3>
    <form method="post" action="/admin/images.php" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="img-drop-zone" id="drop-zone">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color:var(--muted)"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
            <p style="margin:.5rem 0 .2rem;font-weight:600;">Drag &amp; drop images here</p>
            <p style="font-size:.82rem;color:var(--muted);">or click to browse — JPG, PNG, WebP · max 8 MB each</p>
            <input type="file" name="slider_image[]" id="file-input" accept="image/*" multiple style="position:absolute;inset:0;opacity:0;cursor:pointer;">
        </div>
        <div id="preview-strip" style="display:none;flex-wrap:wrap;gap:.5rem;margin-top:.75rem;"></div>
        <div style="margin-top:1rem;">
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
    </form>
</div>

<!-- Current slides -->
<div class="admin-card">
    <h3 class="settings-section-title" style="margin-bottom:1rem;">
        Current Slides
        <span style="font-weight:400;font-size:.85rem;color:var(--muted);margin-left:.5rem;">(<?= count($slides) ?>)</span>
    </h3>

    <?php if (empty($slides)): ?>
    <p style="color:var(--muted);padding:2rem 0;text-align:center;">No slides yet — upload some above.</p>
    <?php else: ?>
    <div class="slides-editor">
        <?php foreach ($slides as $i => $slide): $fname = basename($slide['image']); ?>
        <div class="slide-row">

            <!-- Thumb + order controls -->
            <div class="slide-thumb-wrap">
                <img src="/<?= h($slide['image']) ?>" alt="Slide <?= $i+1 ?>">
                <span class="slide-num"><?= $i+1 ?></span>
                <div class="slide-order-btns">
                    <form method="post"><<?= csrf_field() ?>
                        <input type="hidden" name="move_image" value="<?= h($slide['image']) ?>">
                        <input type="hidden" name="direction"  value="up">
                        <button class="order-btn" <?= $i===0?'disabled':'' ?> title="Move up">▲</button>
                    </form>
                    <form method="post"><?= csrf_field() ?>
                        <input type="hidden" name="move_image" value="<?= h($slide['image']) ?>">
                        <input type="hidden" name="direction"  value="down">
                        <button class="order-btn" <?= $i===count($slides)-1?'disabled':'' ?> title="Move down">▼</button>
                    </form>
                </div>
            </div>

            <!-- Text editor -->
            <form method="post" class="slide-text-form">
                <?= csrf_field() ?>
                <input type="hidden" name="update_text"   value="1">
                <input type="hidden" name="slide_index"   value="<?= $i ?>">
                <div class="form-group" style="margin-bottom:.6rem;">
                    <label style="font-size:.8rem;font-weight:600;color:var(--muted);">SLIDE TITLE</label>
                    <input type="text" name="slide_title" value="<?= h($slide['title']) ?>"
                           placeholder="e.g. Building Futures Together" style="font-size:.95rem;">
                </div>
                <div class="form-group" style="margin-bottom:.75rem;">
                    <label style="font-size:.8rem;font-weight:600;color:var(--muted);">SLIDE SUBTITLE</label>
                    <textarea name="slide_subtitle" rows="2"
                              placeholder="e.g. Every child deserves a safe home and an education."
                              style="font-size:.88rem;resize:vertical;"><?= h($slide['subtitle']) ?></textarea>
                </div>
                <div style="display:flex;gap:.5rem;align-items:center;">
                    <button type="submit" class="btn btn-primary" style="padding:.4rem 1rem;font-size:.85rem;">Save Text</button>
                    <form method="post" style="margin:0;" onsubmit="return confirm('Delete this slide?')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="delete_image" value="<?= h($fname) ?>">
                        <button type="submit" class="btn" style="padding:.4rem 1rem;font-size:.85rem;background:#fee2e2;color:var(--danger);border:none;">Delete Slide</button>
                    </form>
                </div>
            </form>

        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<style>
.img-drop-zone {
    position:relative; border:2px dashed var(--border); border-radius:var(--radius);
    padding:2rem; text-align:center; cursor:pointer; transition:border-color .2s,background .2s;
}
.img-drop-zone.drag-over { border-color:var(--red); background:var(--red-light); }

.slides-editor { display:flex; flex-direction:column; gap:1.25rem; }

.slide-row {
    display:grid; grid-template-columns:180px 1fr; gap:1.25rem;
    border:1px solid var(--border); border-radius:var(--radius); padding:1rem; background:#fff;
}
.slide-thumb-wrap {
    position:relative; border-radius:8px; overflow:hidden;
    aspect-ratio:16/9; background:#000;
    display:flex; flex-direction:column;
}
.slide-thumb-wrap img { width:100%;height:100%;object-fit:cover;opacity:.85; }
.slide-num {
    position:absolute;top:6px;left:8px;background:rgba(0,0,0,.6);color:#fff;
    font-size:.7rem;font-weight:700;padding:2px 7px;border-radius:20px;
}
.slide-order-btns {
    position:absolute;bottom:6px;right:6px;display:flex;gap:4px;
}
.order-btn {
    background:rgba(0,0,0,.55);border:none;color:#fff;border-radius:5px;
    width:26px;height:26px;cursor:pointer;font-size:.75rem;line-height:1;
    display:flex;align-items:center;justify-content:center;
}
.order-btn:disabled { opacity:.3;cursor:default; }
.order-btn:hover:not(:disabled) { background:rgba(0,0,0,.8); }

.slide-text-form { display:flex;flex-direction:column;justify-content:center; }

#preview-strip img { height:65px;width:auto;border-radius:6px;border:2px solid var(--red);object-fit:cover; }

@media(max-width:640px) {
    .slide-row { grid-template-columns:1fr; }
    .slide-thumb-wrap { aspect-ratio:16/6; }
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
dz.addEventListener('dragover',  e => { e.preventDefault(); dz.classList.add('drag-over'); });
dz.addEventListener('dragleave', ()=> dz.classList.remove('drag-over'));
dz.addEventListener('drop', e => {
    e.preventDefault(); dz.classList.remove('drag-over');
    const dt = new DataTransfer();
    [...e.dataTransfer.files].filter(f => f.type.startsWith('image/')).forEach(f => dt.items.add(f));
    inp.files = dt.files;
    showPreviews(inp.files);
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
