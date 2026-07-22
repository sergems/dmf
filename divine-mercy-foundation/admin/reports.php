<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

$admin_title = 'Annual Reports';
$pdo    = get_db();
$errors = [];

$upload_dir = dirname(__DIR__) . '/uploads/reports/';
if (!is_dir($upload_dir)) mkdir($upload_dir, 0775, true);

// ── helpers ──────────────────────────────────────────────────
function upsert_setting_r(PDO $pdo, string $key, string $val): void {
    if (DB_DRIVER === 'sqlite') {
        $pdo->prepare("INSERT OR REPLACE INTO settings (setting_key,setting_value) VALUES (?,?)")->execute([$key,$val]);
    } else {
        $pdo->prepare("INSERT INTO settings (setting_key,setting_value) VALUES (?,?)
            ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value)")->execute([$key,$val]);
    }
}

// ── ADD / EDIT report row (no file) ──────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_report'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $year  = (int)($_POST['year'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $desc  = trim($_POST['description'] ?? '');
        if ($year < 2000 || $year > 2100) $errors[] = 'Please enter a valid year.';
        if (!$title)                       $errors[] = 'Title is required.';
        if (!$errors) {
            if (DB_DRIVER === 'sqlite') {
                $pdo->prepare("INSERT INTO reports (year,title,description) VALUES (?,?,?)
                    ON CONFLICT(year) DO UPDATE SET title=excluded.title, description=excluded.description")
                    ->execute([$year,$title,$desc]);
            } else {
                $pdo->prepare("INSERT INTO reports (year,title,description) VALUES (?,?,?)
                    ON DUPLICATE KEY UPDATE title=VALUES(title), description=VALUES(description)")
                    ->execute([$year,$title,$desc]);
            }
            set_flash('success', "Report entry for $year saved.");
            redirect('/admin/reports.php');
        }
    }
}

// ── UPLOAD PDF ────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['report_pdf'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $year = (int)($_POST['upload_year'] ?? 0);
        $file = $_FILES['report_pdf'];

        if ($year < 2000 || $year > 2100)               $errors[] = 'Invalid year.';
        elseif ($file['error'] !== UPLOAD_ERR_OK)        $errors[] = 'Upload failed (error ' . $file['error'] . ').';
        elseif ($file['size'] > 32 * 1024 * 1024)       $errors[] = 'File exceeds 32 MB limit.';
        elseif (mime_content_type($file['tmp_name']) !== 'application/pdf') $errors[] = 'Only PDF files are accepted.';
        else {
            // Check year row exists
            $row = $pdo->prepare("SELECT id FROM reports WHERE year=?");
            $row->execute([$year]);
            if (!$row->fetch()) $errors[] = "No report entry exists for $year. Add the year entry first.";
            else {
                $fname = 'report-' . $year . '-' . uniqid() . '.pdf';
                if (move_uploaded_file($file['tmp_name'], $upload_dir . $fname)) {
                    // Delete old file if exists
                    $old = $pdo->prepare("SELECT filename FROM reports WHERE year=?");
                    $old->execute([$year]);
                    $oldname = $old->fetchColumn();
                    if ($oldname && file_exists($upload_dir . $oldname)) @unlink($upload_dir . $oldname);

                    $pdo->prepare("UPDATE reports SET filename=?, uploaded_at=datetime('now') WHERE year=?")
                        ->execute([$fname, $year]);
                    set_flash('success', "PDF for $year uploaded successfully.");
                    redirect('/admin/reports.php');
                } else {
                    $errors[] = 'Could not save the file. Check server permissions.';
                }
            }
        }
    }
}

// ── DELETE PDF (remove file, keep row) ───────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_pdf'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $year = (int)$_POST['remove_pdf'];
        $row  = $pdo->prepare("SELECT filename FROM reports WHERE year=?");
        $row->execute([$year]);
        $fname = $row->fetchColumn();
        if ($fname && file_exists($upload_dir . $fname)) @unlink($upload_dir . $fname);
        $pdo->prepare("UPDATE reports SET filename=NULL WHERE year=?")->execute([$year]);
        set_flash('success', "PDF for $year removed.");
        redirect('/admin/reports.php');
    }
}

// ── DELETE ROW entirely ───────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_report'])) {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $year = (int)$_POST['delete_report'];
        $row  = $pdo->prepare("SELECT filename FROM reports WHERE year=?");
        $row->execute([$year]);
        $fname = $row->fetchColumn();
        if ($fname && file_exists($upload_dir . $fname)) @unlink($upload_dir . $fname);
        $pdo->prepare("DELETE FROM reports WHERE year=?")->execute([$year]);
        set_flash('success', "Report for $year deleted.");
        redirect('/admin/reports.php');
    }
}

$reports = $pdo->query("SELECT * FROM reports ORDER BY year DESC")->fetchAll();
require_once __DIR__ . '/includes/header.php';
?>

<?= render_flash() ?>
<?php if ($errors): ?>
<div class="alert alert-error"><?php foreach ($errors as $e): ?><p><?= h($e) ?></p><?php endforeach; ?></div>
<?php endif; ?>

<p style="color:var(--muted);margin-bottom:1.5rem;">
    Add a year entry first, then upload its PDF. The public Reports page updates automatically.
</p>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;align-items:start;">

    <!-- Add / edit year entry -->
    <div class="admin-card">
        <h3 class="settings-section-title" style="margin-bottom:1rem;">Add New Year Entry</h3>
        <form method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label>Year</label>
                <input type="number" name="year" min="2000" max="2100"
                       value="<?= date('Y') ?>" style="width:120px;" required>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="Annual Report <?= date('Y') ?>" required>
            </div>
            <div class="form-group">
                <label>Short Description</label>
                <textarea name="description" rows="2" placeholder="Programme outcomes, financial summary and impact for the <?= date('Y') ?> fiscal year."></textarea>
            </div>
            <button type="submit" name="save_report" class="btn btn-primary">Save Entry</button>
        </form>
    </div>

    <!-- Upload PDF -->
    <div class="admin-card">
        <h3 class="settings-section-title" style="margin-bottom:1rem;">Upload PDF for a Year</h3>
        <form method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group">
                <label>Year</label>
                <select name="upload_year" style="width:140px;">
                    <?php foreach ($reports as $r): ?>
                    <option value="<?= $r['year'] ?>"><?= $r['year'] ?></option>
                    <?php endforeach; ?>
                    <?php if (empty($reports)): ?>
                    <option disabled>— Add a year entry first —</option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label>PDF File <small style="color:var(--muted);">(max 32 MB)</small></label>
                <div class="pdf-drop-zone" id="pdf-drop-zone">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color:var(--muted)"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    <p id="pdf-label" style="margin:.4rem 0 0;font-size:.88rem;">Click to choose PDF or drag &amp; drop</p>
                    <input type="file" name="report_pdf" id="pdf-input" accept=".pdf,application/pdf"
                           style="position:absolute;inset:0;opacity:0;cursor:pointer;" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Upload PDF</button>
        </form>
    </div>

</div>

<!-- Reports list -->
<div class="admin-card" style="margin-top:1.5rem;">
    <h3 class="settings-section-title" style="margin-bottom:1rem;">
        All Reports
        <span style="font-weight:400;font-size:.85rem;color:var(--muted);margin-left:.5rem;">(<?= count($reports) ?>)</span>
    </h3>

    <?php if (empty($reports)): ?>
    <p style="color:var(--muted);text-align:center;padding:2rem 0;">No reports yet — add a year entry above.</p>
    <?php else: ?>
    <table class="reports-admin-table">
        <thead>
            <tr>
                <th>Year</th>
                <th>Title</th>
                <th>Description</th>
                <th>PDF</th>
                <th>Uploaded</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($reports as $r): ?>
        <tr>
            <td><strong><?= h($r['year']) ?></strong></td>
            <td><?= h($r['title']) ?></td>
            <td style="color:var(--muted);font-size:.85rem;"><?= h(mb_strimwidth($r['description'] ?? '', 0, 60, '…')) ?></td>
            <td>
                <?php if ($r['filename']): ?>
                <a href="/uploads/reports/<?= h($r['filename']) ?>" target="_blank"
                   class="badge badge-green">⬇ PDF Ready</a>
                <?php else: ?>
                <span class="badge badge-gray">No PDF</span>
                <?php endif; ?>
            </td>
            <td style="font-size:.82rem;color:var(--muted);">
                <?= $r['uploaded_at'] ? date('d M Y', strtotime($r['uploaded_at'])) : '—' ?>
            </td>
            <td style="white-space:nowrap;">
                <?php if ($r['filename']): ?>
                <form method="post" style="display:inline"
                      onsubmit="return confirm('Remove the PDF for <?= $r['year'] ?>? The year entry will remain.')">
                    <?= csrf_field() ?>
                    <input type="hidden" name="remove_pdf" value="<?= $r['year'] ?>">
                    <button type="submit" class="tbl-btn tbl-btn-warn">Remove PDF</button>
                </form>
                <?php endif; ?>
                <form method="post" style="display:inline"
                      onsubmit="return confirm('Permanently delete the <?= $r['year'] ?> entry and its PDF?')">
                    <?= csrf_field() ?>
                    <input type="hidden" name="delete_report" value="<?= $r['year'] ?>">
                    <button type="submit" class="tbl-btn tbl-btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<style>
.pdf-drop-zone {
    position:relative; border:2px dashed var(--border); border-radius:var(--radius);
    padding:1.5rem; text-align:center; cursor:pointer; transition:border-color .2s,background .2s;
}
.pdf-drop-zone.drag-over { border-color:var(--red); background:var(--red-light); }
.pdf-drop-zone.has-file   { border-color:var(--success); background:#f0fdf4; }

.reports-admin-table { width:100%; border-collapse:collapse; font-size:.9rem; }
.reports-admin-table th {
    text-align:left; padding:.6rem .75rem; font-size:.75rem; font-weight:600;
    color:var(--muted); text-transform:uppercase; letter-spacing:.05em;
    border-bottom:2px solid var(--border);
}
.reports-admin-table td { padding:.65rem .75rem; border-bottom:1px solid var(--border); vertical-align:middle; }
.reports-admin-table tr:last-child td { border-bottom:none; }
.reports-admin-table tr:hover td { background:var(--bg); }

.badge { display:inline-block; padding:.25rem .65rem; border-radius:20px; font-size:.78rem; font-weight:600; }
.badge-green { background:#d1fae5; color:#065f46; }
.badge-gray  { background:#f3f4f6; color:var(--muted); }

.tbl-btn {
    padding:.3rem .7rem; border-radius:6px; border:none; font-size:.8rem;
    cursor:pointer; font-weight:500; transition:background .15s;
}
.tbl-btn-warn   { background:#fef3c7; color:#92400e; margin-right:.3rem; }
.tbl-btn-warn:hover   { background:#fde68a; }
.tbl-btn-danger { background:#fee2e2; color:var(--danger); }
.tbl-btn-danger:hover { background:#fecaca; }

@media(max-width:700px) {
    div[style*="grid-template-columns:1fr 1fr"] { grid-template-columns:1fr !important; }
}
</style>

<script>
const dz  = document.getElementById('pdf-drop-zone');
const inp = document.getElementById('pdf-input');
const lbl = document.getElementById('pdf-label');

inp.addEventListener('change', () => {
    if (inp.files[0]) {
        lbl.textContent = inp.files[0].name;
        dz.classList.add('has-file');
    }
});
dz.addEventListener('dragover',  e => { e.preventDefault(); dz.classList.add('drag-over'); });
dz.addEventListener('dragleave', () => dz.classList.remove('drag-over'));
dz.addEventListener('drop', e => {
    e.preventDefault(); dz.classList.remove('drag-over');
    const f = [...e.dataTransfer.files].find(f => f.type === 'application/pdf');
    if (f) {
        const dt = new DataTransfer(); dt.items.add(f);
        inp.files = dt.files;
        lbl.textContent = f.name;
        dz.classList.add('has-file');
    }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
