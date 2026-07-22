<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

$admin_title = 'Orphanage Page';
$pdo   = get_db();
$errors = [];

// ── Ensure tables exist (auto-migration) ─────────────────────
$pdo->exec("
CREATE TABLE IF NOT EXISTS orphanage_albums (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    eyebrow     TEXT NOT NULL DEFAULT '',
    heading     TEXT NOT NULL DEFAULT '',
    description TEXT DEFAULT '',
    sort_order  INTEGER DEFAULT 0,
    created_at  TEXT DEFAULT (datetime('now'))
);
CREATE TABLE IF NOT EXISTS orphanage_photos (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    album_id   INTEGER NOT NULL REFERENCES orphanage_albums(id) ON DELETE CASCADE,
    src        TEXT NOT NULL,
    caption    TEXT DEFAULT '',
    sort_order INTEGER DEFAULT 0
);
");

$upload_dir = dirname(__DIR__) . '/uploads/orphanage/';
if (!is_dir($upload_dir)) mkdir($upload_dir, 0775, true);

// ─────────────────────────────────────────────────────────────
// POST: save text section
// ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_text'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $key     = trim($_POST['page_key']  ?? '');
        $title   = trim($_POST['title']     ?? '');
        $content = trim($_POST['content']   ?? '');
        $allowed = ['orphanage_progress_update','orphanage_about_project',
                    'orphanage_story','orphanage_location',
                    'orphanage_children_intro','orphanage_volunteer_text'];
        if (in_array($key, $allowed, true)) {
            if (DB_DRIVER === 'sqlite') {
                $pdo->prepare("INSERT OR REPLACE INTO page_content (page_key,title,content) VALUES(?,?,?)")->execute([$key,$title,$content]);
            } else {
                $pdo->prepare("INSERT INTO page_content (page_key,title,content) VALUES(?,?,?)
                    ON DUPLICATE KEY UPDATE title=VALUES(title),content=VALUES(content)")->execute([$key,$title,$content]);
            }
            set_flash('success','Text section saved.');
        }
        redirect('/admin/orphanage.php#text-sections');
    }
}

// ─────────────────────────────────────────────────────────────
// POST: create album
// ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_album'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $eyebrow = trim($_POST['eyebrow']      ?? '');
        $heading = trim($_POST['heading']      ?? '');
        $desc    = trim($_POST['description']  ?? '');
        if ($eyebrow && $heading) {
            $max = $pdo->query("SELECT COALESCE(MAX(sort_order),0) FROM orphanage_albums")->fetchColumn();
            $pdo->prepare("INSERT INTO orphanage_albums (eyebrow,heading,description,sort_order) VALUES(?,?,?,?)")->execute([$eyebrow,$heading,$desc,$max+1]);
            set_flash('success','Album created.');
        } else {
            set_flash('error','Eyebrow label and heading are required.');
        }
        redirect('/admin/orphanage.php#albums');
    }
}

// ─────────────────────────────────────────────────────────────
// POST: edit album metadata
// ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_album'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $id      = (int)$_POST['album_id'];
        $eyebrow = trim($_POST['eyebrow']     ?? '');
        $heading = trim($_POST['heading']     ?? '');
        $desc    = trim($_POST['description'] ?? '');
        if ($eyebrow && $heading) {
            $pdo->prepare("UPDATE orphanage_albums SET eyebrow=?,heading=?,description=? WHERE id=?")
                ->execute([$eyebrow,$heading,$desc,$id]);
            set_flash('success','Album updated.');
        }
        redirect('/admin/orphanage.php#album-'.$id);
    }
}

// ─────────────────────────────────────────────────────────────
// POST: delete album
// ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_album'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $id = (int)$_POST['album_id'];
        $ps = $pdo->prepare("SELECT src FROM orphanage_photos WHERE album_id=?");
        $ps->execute([$id]);
        foreach ($ps->fetchAll() as $p) {
            if (!str_starts_with($p['src'],'http')) @unlink(dirname(__DIR__).'/'.$p['src']);
        }
        $pdo->prepare("DELETE FROM orphanage_albums WHERE id=?")->execute([$id]);
        set_flash('success','Album deleted.');
        redirect('/admin/orphanage.php#albums');
    }
}

// ─────────────────────────────────────────────────────────────
// POST: move album
// ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['move_album'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $id  = (int)$_POST['album_id'];
        $dir = ($_POST['direction'] === 'up') ? -1 : 1;
        $list = $pdo->query("SELECT id,sort_order FROM orphanage_albums ORDER BY sort_order,id")->fetchAll();
        $idx  = array_search($id, array_column($list,'id'));
        $swap = $idx + $dir;
        if ($idx !== false && isset($list[$swap])) {
            [$a,$b] = [$list[$idx],$list[$swap]];
            $pdo->prepare("UPDATE orphanage_albums SET sort_order=? WHERE id=?")->execute([$b['sort_order'],$a['id']]);
            $pdo->prepare("UPDATE orphanage_albums SET sort_order=? WHERE id=?")->execute([$a['sort_order'],$b['id']]);
        }
        redirect('/admin/orphanage.php#albums');
    }
}

// ─────────────────────────────────────────────────────────────
// POST: upload photos to album
// ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photos'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $album_id  = (int)($_POST['album_id'] ?? 0);
        $allowed   = ['image/jpeg','image/jpg','image/png','image/webp','image/gif'];
        $max_bytes = 16 * 1024 * 1024;
        $ups = $_FILES['photos'];
        if (!is_array($ups['name'])) { foreach ($ups as $k=>$v) $ups[$k]=[$v]; }
        $ms = $pdo->prepare("SELECT COALESCE(MAX(sort_order),0) FROM orphanage_photos WHERE album_id=?");
        $ms->execute([$album_id]);
        $sort = $ms->fetchColumn();
        $ins  = $pdo->prepare("INSERT INTO orphanage_photos (album_id,src,sort_order) VALUES(?,?,?)");
        foreach ($ups['name'] as $i => $orig) {
            if ($ups['error'][$i] === UPLOAD_ERR_NO_FILE) continue;
            if ($ups['error'][$i] !== UPLOAD_ERR_OK)       { $errors[]="Upload error for \"$orig\"."; continue; }
            if ($ups['size'][$i]  > $max_bytes)             { $errors[]="\"$orig\" exceeds 16 MB.";    continue; }
            $mime = mime_content_type($ups['tmp_name'][$i]);
            if (!in_array($mime,$allowed,true))             { $errors[]="\"$orig\" is not an allowed image type."; continue; }
            $ext   = match($mime){'image/png'=>'png','image/webp'=>'webp','image/gif'=>'gif',default=>'jpg'};
            $fname = 'orphanage-'.uniqid().'.'.$ext;
            if (move_uploaded_file($ups['tmp_name'][$i], $upload_dir.$fname)) {
                $sort++;
                $ins->execute([$album_id,'uploads/orphanage/'.$fname,$sort]);
            } else {
                $errors[]="Could not save \"$orig\".";
            }
        }
        if (!$errors) { set_flash('success','Photo(s) uploaded.'); }
        redirect('/admin/orphanage.php#album-'.$album_id);
    }
}

// ─────────────────────────────────────────────────────────────
// POST: add external URL photo
// ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_external'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $album_id = (int)$_POST['album_id'];
        $url      = trim($_POST['ext_url'] ?? '');
        $caption  = trim($_POST['caption'] ?? '');
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $ms = $pdo->prepare("SELECT COALESCE(MAX(sort_order),0) FROM orphanage_photos WHERE album_id=?");
            $ms->execute([$album_id]);
            $sort = $ms->fetchColumn() + 1;
            $pdo->prepare("INSERT INTO orphanage_photos (album_id,src,caption,sort_order) VALUES(?,?,?,?)")->execute([$album_id,$url,$caption,$sort]);
            set_flash('success','External photo added.');
        } else {
            set_flash('error','Invalid URL entered.');
        }
        redirect('/admin/orphanage.php#album-'.$album_id);
    }
}

// ─────────────────────────────────────────────────────────────
// POST: update photo caption
// ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_caption'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $photo_id = (int)$_POST['photo_id'];
        $album_id = (int)$_POST['album_id'];
        $caption  = trim($_POST['caption'] ?? '');
        $pdo->prepare("UPDATE orphanage_photos SET caption=? WHERE id=?")->execute([$caption,$photo_id]);
        set_flash('success','Caption saved.');
        redirect('/admin/orphanage.php#album-'.$album_id);
    }
}

// ─────────────────────────────────────────────────────────────
// POST: delete photo
// ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_photo'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $photo_id = (int)$_POST['photo_id'];
        $album_id = (int)$_POST['album_id'];
        $row = $pdo->prepare("SELECT src FROM orphanage_photos WHERE id=?");
        $row->execute([$photo_id]);
        $r = $row->fetch();
        if ($r && !str_starts_with($r['src'],'http')) @unlink(dirname(__DIR__).'/'.$r['src']);
        $pdo->prepare("DELETE FROM orphanage_photos WHERE id=?")->execute([$photo_id]);
        set_flash('success','Photo deleted.');
        redirect('/admin/orphanage.php#album-'.$album_id);
    }
}

// ─────────────────────────────────────────────────────────────
// POST: move photo
// ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['move_photo'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $photo_id = (int)$_POST['photo_id'];
        $album_id = (int)$_POST['album_id'];
        $dir      = ($_POST['direction'] === 'up') ? -1 : 1;
        $stmt     = $pdo->prepare("SELECT id,sort_order FROM orphanage_photos WHERE album_id=? ORDER BY sort_order,id");
        $stmt->execute([$album_id]);
        $list = $stmt->fetchAll();
        $idx  = array_search($photo_id, array_column($list,'id'));
        $swap = $idx + $dir;
        if ($idx !== false && isset($list[$swap])) {
            [$a,$b] = [$list[$idx],$list[$swap]];
            $pdo->prepare("UPDATE orphanage_photos SET sort_order=? WHERE id=?")->execute([$b['sort_order'],$a['id']]);
            $pdo->prepare("UPDATE orphanage_photos SET sort_order=? WHERE id=?")->execute([$a['sort_order'],$b['id']]);
        }
        redirect('/admin/orphanage.php#album-'.$album_id);
    }
}

// ─────────────────────────────────────────────────────────────
// Load data
// ─────────────────────────────────────────────────────────────
$text_sections = [
    'orphanage_progress_update' => 'Progress Update',
    'orphanage_about_project'   => 'About the Project',
    'orphanage_story'           => 'Our Story',
    'orphanage_location'        => 'Location',
    'orphanage_children_intro'  => 'Children Intro',
    'orphanage_volunteer_text'  => 'Volunteer / Support Text',
];
$texts = [];
foreach ($text_sections as $key => $_) $texts[$key] = get_page_content($key);

$albums = $pdo->query("SELECT * FROM orphanage_albums ORDER BY sort_order,id")->fetchAll();
$photos_by_album = [];
foreach ($albums as $a) {
    $s = $pdo->prepare("SELECT * FROM orphanage_photos WHERE album_id=? ORDER BY sort_order,id");
    $s->execute([$a['id']]);
    $photos_by_album[$a['id']] = $s->fetchAll();
}

require_once __DIR__ . '/includes/header.php';
?>

<?= render_flash() ?>
<?php if ($errors): ?>
<div class="alert alert-error"><?php foreach ($errors as $e): ?><p><?= h($e) ?></p><?php endforeach; ?></div>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════════════
     TEXT SECTIONS
═══════════════════════════════════════════════════════════ -->
<div id="text-sections" class="admin-card" style="margin-bottom:2rem;">
    <h3 class="settings-section-title" style="margin-bottom:1.25rem;">
        📝 Text Sections
        <span style="font-weight:400;font-size:.82rem;color:var(--muted);margin-left:.5rem;">Edit the written content on the orphanage page</span>
    </h3>
    <div class="text-accordion">
        <?php foreach ($text_sections as $key => $label):
            $t = $texts[$key];
            $preview = mb_substr(strip_tags($t['content']), 0, 90);
        ?>
        <details class="text-section-item">
            <summary class="text-section-summary">
                <span class="ts-label"><?= h($label) ?></span>
                <span class="ts-preview"><?= h($preview) ?>…</span>
                <span class="ts-chevron">›</span>
            </summary>
            <div class="text-section-body">
                <form method="post" action="/admin/orphanage.php">
                    <?= csrf_field() ?>
                    <input type="hidden" name="save_text" value="1">
                    <input type="hidden" name="page_key"  value="<?= h($key) ?>">
                    <div class="form-group">
                        <label>Section Heading</label>
                        <input type="text" name="title" value="<?= h($t['title']) ?>" style="max-width:480px;">
                    </div>
                    <div class="form-group">
                        <label>Content <small style="color:var(--muted);font-weight:400;">(plain text — line breaks are preserved)</small></label>
                        <textarea name="content" rows="8" style="resize:vertical;"><?= h($t['content']) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="font-size:.88rem;">Save Section</button>
                </form>
            </div>
        </details>
        <?php endforeach; ?>
    </div>
</div>

<!-- ══════════════════════════════════════════════════════════
     PHOTO ALBUMS
═══════════════════════════════════════════════════════════ -->
<div id="albums" class="admin-card" style="margin-bottom:2rem;">
    <h3 class="settings-section-title" style="margin-bottom:1.25rem;">
        🖼 Photo Albums
        <span style="font-weight:400;font-size:.82rem;color:var(--muted);margin-left:.5rem;"><?= count($albums) ?> album<?= count($albums)!==1?'s':'' ?> — newest first on the public page</span>
    </h3>

    <!-- ── Create new album ── -->
    <details class="create-album-panel">
        <summary class="create-album-summary">
            <span style="font-size:1.15rem;line-height:1;">＋</span> Add New Album
        </summary>
        <div style="margin-top:1rem;">
            <form method="post" action="/admin/orphanage.php">
                <?= csrf_field() ?>
                <input type="hidden" name="create_album" value="1">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                    <div class="form-group">
                        <label>Eyebrow Label <small style="color:var(--muted)">(e.g. "October 2026")</small></label>
                        <input type="text" name="eyebrow" placeholder="October 2026" required>
                    </div>
                    <div class="form-group">
                        <label>Album Heading <small style="color:var(--muted)">(shown as h2)</small></label>
                        <input type="text" name="heading" placeholder="October 2026 Visit Photos" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description <small style="color:var(--muted)">(optional — shown under the heading)</small></label>
                    <textarea name="description" rows="2" style="resize:vertical;" placeholder="A short description of what these photos show…"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Album</button>
            </form>
        </div>
    </details>

    <!-- ── Album list ── -->
    <?php if (empty($albums)): ?>
    <p style="color:var(--muted);text-align:center;padding:2.5rem 0;">No albums yet — create one above.</p>
    <?php endif; ?>

    <?php $total = count($albums);
          foreach ($albums as $ai => $album):
        $photos = $photos_by_album[$album['id']] ?? [];
    ?>
    <div id="album-<?= $album['id'] ?>" class="album-panel">

        <!-- Album header -->
        <div class="album-header">
            <div class="album-header-left">
                <div class="album-eyebrow"><?= h($album['eyebrow']) ?></div>
                <div class="album-heading"><?= h($album['heading']) ?></div>
                <div class="album-meta"><?= count($photos) ?> photo<?= count($photos)!==1?'s':'' ?></div>
            </div>
            <div class="album-header-right">
                <form method="post" style="display:inline;">
                    <?= csrf_field() ?>
                    <input type="hidden" name="move_album" value="1">
                    <input type="hidden" name="album_id"   value="<?= $album['id'] ?>">
                    <input type="hidden" name="direction"  value="up">
                    <button class="icon-btn" title="Move up (shown earlier)" <?= $ai===0?'disabled':'' ?>>▲</button>
                </form>
                <form method="post" style="display:inline;">
                    <?= csrf_field() ?>
                    <input type="hidden" name="move_album" value="1">
                    <input type="hidden" name="album_id"   value="<?= $album['id'] ?>">
                    <input type="hidden" name="direction"  value="down">
                    <button class="icon-btn" title="Move down (shown later)" <?= $ai===$total-1?'disabled':'' ?>>▼</button>
                </form>
                <button class="btn btn-sm album-toggle-btn" data-target="album-body-<?= $album['id'] ?>">
                    Manage ›
                </button>
            </div>
        </div>

        <!-- Album body -->
        <div id="album-body-<?= $album['id'] ?>" class="album-body" style="display:none;">

            <!-- Edit metadata -->
            <div class="album-section">
                <div class="album-section-title">Album Details</div>
                <form method="post" action="/admin/orphanage.php">
                    <?= csrf_field() ?>
                    <input type="hidden" name="edit_album" value="1">
                    <input type="hidden" name="album_id"   value="<?= $album['id'] ?>">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:.75rem;">
                        <div class="form-group" style="margin:0;">
                            <label>Eyebrow</label>
                            <input type="text" name="eyebrow" value="<?= h($album['eyebrow']) ?>" required>
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label>Heading</label>
                            <input type="text" name="heading" value="<?= h($album['heading']) ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="2" style="resize:vertical;"><?= h($album['description']) ?></textarea>
                    </div>
                    <div style="display:flex;gap:.75rem;align-items:center;flex-wrap:wrap;">
                        <button type="submit" class="btn btn-primary btn-sm">Save Details</button>
                    </div>
                </form>
                <form method="post" style="margin-top:.75rem;" onsubmit="return confirm('Delete this entire album and all its photos? This cannot be undone.')">
                    <?= csrf_field() ?>
                    <input type="hidden" name="delete_album" value="1">
                    <input type="hidden" name="album_id"     value="<?= $album['id'] ?>">
                    <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#c0392b;border:none;">🗑 Delete Entire Album</button>
                </form>
            </div>

            <!-- Current photos -->
            <div class="album-section">
                <div class="album-section-title">Photos (<?= count($photos) ?>)</div>
                <?php if (empty($photos)): ?>
                <p style="color:var(--muted);font-size:.88rem;padding:.5rem 0;">No photos yet — upload some below.</p>
                <?php else: ?>
                <div class="photo-grid">
                    <?php foreach ($photos as $pi => $p):
                        $src = str_starts_with($p['src'],'http') ? $p['src'] : '/'.$p['src'];
                    ?>
                    <div class="photo-item">
                        <div class="photo-thumb-wrap">
                            <img src="<?= h($src) ?>" alt="<?= h($p['caption'] ?: 'Orphanage photo') ?>" loading="lazy">
                            <div class="photo-order-btns">
                                <form method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="move_photo" value="1">
                                    <input type="hidden" name="photo_id"   value="<?= $p['id'] ?>">
                                    <input type="hidden" name="album_id"   value="<?= $album['id'] ?>">
                                    <input type="hidden" name="direction"  value="up">
                                    <button class="order-btn" <?= $pi===0?'disabled':'' ?> title="Move earlier">◀</button>
                                </form>
                                <form method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="move_photo" value="1">
                                    <input type="hidden" name="photo_id"   value="<?= $p['id'] ?>">
                                    <input type="hidden" name="album_id"   value="<?= $album['id'] ?>">
                                    <input type="hidden" name="direction"  value="down">
                                    <button class="order-btn" <?= $pi===count($photos)-1?'disabled':'' ?> title="Move later">▶</button>
                                </form>
                            </div>
                        </div>
                        <form method="post" class="photo-caption-form">
                            <?= csrf_field() ?>
                            <input type="hidden" name="update_caption" value="1">
                            <input type="hidden" name="photo_id" value="<?= $p['id'] ?>">
                            <input type="hidden" name="album_id" value="<?= $album['id'] ?>">
                            <input type="text" name="caption" value="<?= h($p['caption']) ?>" placeholder="Caption…" style="font-size:.75rem;padding:.22rem .4rem;width:100%;border-radius:4px;border:1px solid var(--border);">
                            <div style="display:flex;gap:.25rem;margin-top:.2rem;">
                                <button type="submit" class="btn btn-sm" style="flex:1;font-size:.72rem;padding:.18rem 0;">Save</button>
                                <form method="post" style="flex:1;margin:0;" onsubmit="return confirm('Delete this photo?')">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="delete_photo" value="1">
                                    <input type="hidden" name="photo_id" value="<?= $p['id'] ?>">
                                    <input type="hidden" name="album_id" value="<?= $album['id'] ?>">
                                    <button type="submit" class="btn btn-sm" style="width:100%;font-size:.72rem;padding:.18rem 0;background:#fee2e2;color:#c0392b;border:none;">Del</button>
                                </form>
                            </div>
                        </form>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Upload new photos -->
            <div class="album-section">
                <div class="album-section-title">Upload New Photos</div>
                <form method="post" action="/admin/orphanage.php" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="album_id" value="<?= $album['id'] ?>">
                    <div class="img-drop-zone mini-dz">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color:var(--muted);margin-bottom:.3rem;"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        <p style="margin:.2rem 0;font-size:.85rem;font-weight:600;">Drag &amp; drop or click to browse</p>
                        <p style="font-size:.75rem;color:var(--muted);">JPG, PNG, WebP · up to 16 MB each</p>
                        <input type="file" name="photos[]" accept="image/*" multiple style="position:absolute;inset:0;opacity:0;cursor:pointer;">
                    </div>
                    <div class="mini-preview" style="display:none;flex-wrap:wrap;gap:.4rem;margin-top:.5rem;"></div>
                    <button type="submit" class="btn btn-primary btn-sm" style="margin-top:.75rem;">Upload to This Album</button>
                </form>

                <!-- External URL -->
                <details style="margin-top:1.1rem;border-top:1px solid var(--border);padding-top:1rem;">
                    <summary style="cursor:pointer;font-size:.85rem;font-weight:600;color:var(--navy);list-style:none;">＋ Add photo by URL (external / WordPress)</summary>
                    <div style="margin-top:.75rem;">
                        <form method="post" action="/admin/orphanage.php" style="display:grid;grid-template-columns:1fr auto;gap:.5rem;align-items:end;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="add_external" value="1">
                            <input type="hidden" name="album_id" value="<?= $album['id'] ?>">
                            <div>
                                <div class="form-group" style="margin-bottom:.5rem;">
                                    <label style="font-size:.8rem;">Photo URL</label>
                                    <input type="url" name="ext_url" placeholder="https://example.com/photo.jpg" required style="font-size:.88rem;">
                                </div>
                                <div class="form-group" style="margin-bottom:0;">
                                    <label style="font-size:.8rem;">Caption (optional)</label>
                                    <input type="text" name="caption" placeholder="e.g. Children in class — November 2025" style="font-size:.88rem;">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm" style="align-self:flex-end;white-space:nowrap;">Add Photo</button>
                        </form>
                    </div>
                </details>
            </div>

        </div><!-- /.album-body -->
    </div><!-- /.album-panel -->
    <?php endforeach; ?>
</div>

<style>
/* ── Text accordion ──────────────────────────────── */
.text-accordion { display:flex;flex-direction:column;gap:.5rem; }
.text-section-item { border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;background:#fff; }
.text-section-summary {
    display:flex;align-items:center;gap:1rem;padding:.9rem 1.1rem;
    cursor:pointer;list-style:none;user-select:none;
}
.text-section-summary::-webkit-details-marker { display:none; }
.ts-label   { font-weight:600;font-size:.9rem;min-width:180px;color:var(--navy); }
.ts-preview { flex:1;font-size:.8rem;color:var(--muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis; }
.ts-chevron { font-size:1.1rem;color:var(--muted);transition:transform .2s;flex-shrink:0; }
details[open] > .text-section-summary .ts-chevron { transform:rotate(90deg); }
.text-section-body { padding:1.25rem 1.1rem;background:var(--bg-light);border-top:1px solid var(--border); }

/* ── Create album panel ──────────────────────────── */
.create-album-panel {
    margin-bottom:1.25rem;background:var(--bg-light);
    border:2px dashed var(--border);border-radius:var(--radius);padding:.9rem 1.1rem;
}
.create-album-summary {
    cursor:pointer;font-weight:600;font-size:.93rem;color:var(--navy);
    list-style:none;display:flex;align-items:center;gap:.5rem;
}
.create-album-summary::-webkit-details-marker { display:none; }

/* ── Album panel ─────────────────────────────────── */
.album-panel { border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;margin-bottom:.85rem;background:#fff; }
.album-header { display:flex;align-items:center;justify-content:space-between;padding:.9rem 1.1rem;gap:1rem; }
.album-header-left  { flex:1;min-width:0; }
.album-header-right { display:flex;align-items:center;gap:.4rem;flex-shrink:0; }
.album-eyebrow { font-size:.68rem;font-weight:700;letter-spacing:.09em;text-transform:uppercase;color:var(--red);margin-bottom:.12rem; }
.album-heading { font-size:.97rem;font-weight:600;color:var(--navy);white-space:nowrap;overflow:hidden;text-overflow:ellipsis; }
.album-meta    { font-size:.76rem;color:var(--muted);margin-top:.1rem; }

.icon-btn { background:var(--bg-light);border:1px solid var(--border);border-radius:5px;width:28px;height:28px;cursor:pointer;font-size:.7rem;display:inline-flex;align-items:center;justify-content:center;padding:0; }
.icon-btn:disabled { opacity:.3;cursor:default; }
.btn-sm { padding:.3rem .85rem;font-size:.82rem; }

.album-body    { border-top:1px solid var(--border); }
.album-section { padding:1rem 1.1rem;border-bottom:1px solid var(--border); }
.album-section:last-child { border-bottom:none; }
.album-section-title { font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);margin-bottom:.85rem; }

/* ── Photo grid ──────────────────────────────────── */
.photo-grid { display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:.65rem; }
.photo-item { display:flex;flex-direction:column;gap:.3rem; }
.photo-thumb-wrap { position:relative;aspect-ratio:4/3;border-radius:6px;overflow:hidden;background:#111; }
.photo-thumb-wrap img { width:100%;height:100%;object-fit:cover;opacity:.88; }
.photo-order-btns { position:absolute;bottom:4px;left:50%;transform:translateX(-50%);display:flex;gap:3px; }
.order-btn { background:rgba(0,0,0,.6);border:none;color:#fff;border-radius:4px;width:24px;height:24px;cursor:pointer;font-size:.65rem;display:flex;align-items:center;justify-content:center;padding:0; }
.order-btn:disabled { opacity:.3;cursor:default; }

/* ── Upload drop zone ────────────────────────────── */
.img-drop-zone { position:relative;border:2px dashed var(--border);border-radius:var(--radius);padding:1.1rem;text-align:center;cursor:pointer;transition:border-color .2s,background .2s; }
.img-drop-zone.drag-over { border-color:var(--red);background:#fff0f0; }

@media(max-width:580px){
    .ts-preview { display:none; }
    .album-header { flex-wrap:wrap; }
    .photo-grid { grid-template-columns:repeat(auto-fill,minmax(95px,1fr)); }
    .album-section form[style*="grid-template-columns:1fr 1fr"] { grid-template-columns:1fr!important; }
}
</style>

<script>
// Toggle album body
document.querySelectorAll('.album-toggle-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const body = document.getElementById(btn.dataset.target);
        const open = body.style.display !== 'none';
        body.style.display = open ? 'none' : 'block';
        btn.textContent = open ? 'Manage ›' : 'Close ×';
    });
});

// Auto-open if URL hash targets an album
(function(){
    const m = location.hash.match(/^#album-(\d+)$/);
    if (m) {
        const body = document.getElementById('album-body-' + m[1]);
        const btn  = document.querySelector('[data-target="album-body-' + m[1] + '"]');
        if (body) { body.style.display = 'block'; if(btn) btn.textContent = 'Close ×'; body.scrollIntoView({behavior:'smooth',block:'start'}); }
    }
})();

// Drop-zone previews for each upload form
document.querySelectorAll('.mini-dz').forEach(dz => {
    const inp   = dz.querySelector('input[type=file]');
    const strip = dz.nextElementSibling; // .mini-preview
    function show(files) {
        strip.innerHTML = '';
        strip.style.display = files.length ? 'flex' : 'none';
        [...files].forEach(f => {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(f);
            img.style.cssText = 'height:52px;width:auto;border-radius:4px;border:2px solid var(--red);object-fit:cover;';
            strip.appendChild(img);
        });
    }
    inp.addEventListener('change', () => show(inp.files));
    dz.addEventListener('dragover', e => { e.preventDefault(); dz.classList.add('drag-over'); });
    dz.addEventListener('dragleave',() => dz.classList.remove('drag-over'));
    dz.addEventListener('drop', e => {
        e.preventDefault(); dz.classList.remove('drag-over');
        const dt = new DataTransfer();
        [...e.dataTransfer.files].filter(f=>f.type.startsWith('image/')).forEach(f=>dt.items.add(f));
        inp.files = dt.files;
        show(inp.files);
    });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
