<?php
/**
 * Seeds orphanage page_content and photo albums from the live site data.
 * Run once: php seed-orphanage.php
 */
putenv('PREVIEW_MODE=1');
require_once __DIR__ . '/config.php';

$db = new PDO('sqlite:' . DB_PATH, null, null, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
$db->exec('PRAGMA journal_mode=WAL; PRAGMA foreign_keys=ON;');

// ── 1. Update page_content entries ────────────────────────────────────────────

$contents = [
    'orphanage_progress_update' => [
        'title'   => 'Building a Home, Step by Step',
        'content' => "We would like to share the progress update of our orphanage. The water tank has been successfully installed, electricity has also been installed. We would like to thank everyone that has donated so far to make this come true — we are truly grateful.\n\nCompletion of the concrete wall to protect the orphanage building and opening space for a chicken coop — progressing toward self-sustainability and healthy feeding of our children.\n\nEvery day, Divine Mercy Foundation provides love, care, education, and a brighter future for vulnerable children — and we still need you.",
    ],
    'orphanage_about_project' => [
        'title'   => 'Our Mission — No Discrimination',
        'content' => "Divine Mercy Foundation is making steady progress in constructing its orphanage in Cameroon, which will provide a safe and nurturing home for 80 children — boys and girls — from across Africa. Currently, we are supporting 60 children who remain with guardians by covering their feeding and tuition expenses, costing approximately \$3,500 monthly.\n\nThe orphanage operates under the Child Protection Act, with a certified social worker, a qualified nurse, and thoroughly vetted and trained staff ensuring child safety and care. Construction has been paused due to a lack of funds, despite significant progress so far. We appeal for donations to help us complete this vital project and provide a permanent sanctuary for these children.\n\nOrphanage progress — listed below are the things that have been built so far. Progress is at a halt due to a lack of funds. All donations have been spent. Thank you for your ongoing and unfailing support.\n\n• Foundation for the first wing of the building (completed)\n• Wall structure for the first wing (still needs to be plastered indoors and outdoors)\n• Roof for the first wing (completed)\n• Foundation for the second wing (completed)\n• Wall structure for the second wing (still needs to be plastered inside and outdoors)\n• Outdoor bathroom facilities (still to be finalised, but usable)\n• Digging of the well (still to be finalised)\n• Concrete wall to deter flooding from rain water (drainage system to follow)\n• Roof on the 2nd part of the building (halfway)\n• Electricity pulled down to the site — COMPLETED\n\nWhat needs a fundraiser right now:\n• All electrical installations for both buildings: \$18,000\n• Fitting windows & doors for both buildings: \$25,500\n• 80 beds and mattresses: \$14,500\n• Plumbing and tiling: \$25,000\n• Kitchen equipment: \$4,000\n• Monthly feeding contribution: \$3,500/month\n\nWe thank you all for your support in building this orphanage with us. We are progressing with you. Please help us finalise the project through your generous contributions.\n\nDivine Mercy Foundation — Orphanage Elizabeth Sana, Yaoundé, Cameroon.",
    ],
];

$upd = $db->prepare("UPDATE page_content SET title=?, content=?, updated_at=datetime('now') WHERE page_key=?");
foreach ($contents as $key => $data) {
    $upd->execute([$data['title'], $data['content'], $key]);
    echo "Updated page_content: $key\n";
}

// ── 2. Clear and re-seed photo albums ─────────────────────────────────────────

$db->exec("DELETE FROM orphanage_photos");
$db->exec("DELETE FROM orphanage_albums");

$albums = [
    [
        'eyebrow'     => 'February 2026',
        'heading'     => 'Latest Progress — February 2026',
        'description' => 'The most recent photos from the orphanage construction site in Yaoundé, Cameroon.',
        'sort_order'  => 1,
        'photos'      => [
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-1-1024x576.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-2-1024x576.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-3-1024x576.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-4-1024x576.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-5-1024x576.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-8-1024x576.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-9-1024x576.jpeg',
        ],
    ],
    [
        'eyebrow'     => 'November 2025',
        'heading'     => 'November 2025 Update',
        'description' => 'Progress photos from November 2025 — water tank installation and continued construction.',
        'sort_order'  => 2,
        'photos'      => [
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-04.57.10-576x1024.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.24.53-576x1024.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.24.53-1-576x1024.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.24.53-2-576x1024.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.08.03-1-1024x576.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.08.03-2-1024x576.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.08.03-3-1024x576.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-05.19.37-849x1024.jpeg',
        ],
    ],
    [
        'eyebrow'     => 'August 2025',
        'heading'     => 'August 2025 Update',
        'description' => 'Photos from August 2025 showing ongoing construction work at the orphanage site.',
        'sort_order'  => 3,
        'photos'      => [
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/08/WhatsApp-Image-2025-08-26-at-06.27.46-1024x576.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/08/WhatsApp-Image-2025-08-26-at-06.27.46-1-1024x576.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/08/WhatsApp-Image-2025-08-26-at-06.34.32-1024x576.jpeg',
        ],
    ],
    [
        'eyebrow'     => 'February 2025',
        'heading'     => 'February 2025 Update',
        'description' => 'Construction photos from February 2025.',
        'sort_order'  => 4,
        'photos'      => [
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/02/WhatsApp-Image-2025-02-26-at-12.09.44.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/02/WhatsApp-Image-2025-02-26-at-12.11.19.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/02/WhatsApp-Image-2025-02-26-at-12.11.19-1.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/02/WhatsApp-Image-2025-02-26-at-12.11.20.jpeg',
        ],
    ],
    [
        'eyebrow'     => 'December 2024',
        'heading'     => 'December 2024 Update',
        'description' => 'Site photos from December 2024, including the building structure and surroundings.',
        'sort_order'  => 5,
        'photos'      => [
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/12/house2.png',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/12/WhatsApp-Image-2024-12-10-at-22.13.32-1.jpeg',
        ],
    ],
    [
        'eyebrow'     => 'May–June 2024',
        'heading'     => 'Construction Progress — Mid 2024',
        'description' => 'Photos documenting the construction milestones reached in May and June 2024.',
        'sort_order'  => 6,
        'photos'      => [
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/06/yaounde.jpg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-30-at-21.40.17.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-30-at-21.40.17-1.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-30-at-21.40.17-2.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-30-at-21.40.17-3.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-24-at-18.19.57-768x346.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-24-at-18.19.57-1-768x346.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-24-at-18.19.57-2-768x346.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-24-at-18.19.57-3-768x346.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-23-at-04.51.38.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-23-at-04.51.38-2.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-23-at-05.12.53-768x346.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-23-at-05.14.41.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-23-at-05.16.36.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-23-at-05.18.36-768x432.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-23-at-05.20.09.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/WhatsApp-Image-2024-05-23-at-05.23.18.jpeg',
        ],
    ],
    [
        'eyebrow'     => 'February 2024',
        'heading'     => 'February 2024 — Foundation Work',
        'description' => 'Early 2024 photos showing foundation and structural work on the orphanage.',
        'sort_order'  => 7,
        'photos'      => [
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/02/image-1-768x346.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/02/image-2-768x346.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/02/image-3-768x346.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/02/image-4-768x346.jpeg',
        ],
    ],
    [
        'eyebrow'     => 'January 2024',
        'heading'     => 'January 2024 — Early Construction',
        'description' => 'The beginning of construction — January 2024.',
        'sort_order'  => 8,
        'photos'      => [
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/01/1-1024x768.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/01/1-1-1024x768.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/01/4-1024x768.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/01/5-1024x768.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/01/6-1024x768.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/01/7-1024x768.jpeg',
        ],
    ],
    [
        'eyebrow'     => 'May 2023',
        'heading'     => 'May 2023 — Children at the Site',
        'description' => 'Photos from May 2023 showing children at the orphanage site in Yaoundé.',
        'sort_order'  => 9,
        'photos'      => [
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2023/05/WhatsApp-Image-2023-05-02-at-18.49.45-576x1024.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2023/05/WhatsApp-Image-2023-05-02-at-18.49.47-576x1024.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2023/05/WhatsApp-Image-2023-05-02-at-18.49.47-1-576x1024.jpeg',
            'https://divinemercyfoundationfrbz.org/wp-content/uploads/2023/05/WhatsApp-Image-2023-05-02-at-18.49.48-576x1024.jpeg',
        ],
    ],
];

$insAlbum = $db->prepare("INSERT INTO orphanage_albums (eyebrow, heading, description, sort_order) VALUES (?,?,?,?)");
$insPhoto = $db->prepare("INSERT INTO orphanage_photos (album_id, src, caption, sort_order) VALUES (?,?,?,?)");

foreach ($albums as $album) {
    $insAlbum->execute([$album['eyebrow'], $album['heading'], $album['description'], $album['sort_order']]);
    $albumId = $db->lastInsertId();
    foreach ($album['photos'] as $i => $url) {
        $insPhoto->execute([$albumId, $url, '', $i]);
    }
    echo "Added album: {$album['heading']} (" . count($album['photos']) . " photos)\n";
}

echo "\n✅ Orphanage page seeded successfully.\n";
