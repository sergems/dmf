<?php
/**
 * Preview database initialiser — SQLite only.
 * Run once: php init-preview-db.php
 */
putenv('PREVIEW_MODE=1');
require_once __DIR__ . '/config.php';

$db = new PDO('sqlite:' . DB_PATH, null, null, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
$db->exec('PRAGMA journal_mode=WAL; PRAGMA foreign_keys=ON;');

$db->exec("
CREATE TABLE IF NOT EXISTS admin_users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    full_name TEXT NOT NULL,
    email TEXT,
    created_at TEXT DEFAULT (datetime('now'))
);

CREATE TABLE IF NOT EXISTS news (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    slug TEXT NOT NULL UNIQUE,
    excerpt TEXT,
    content TEXT NOT NULL,
    featured_image TEXT,
    category TEXT DEFAULT 'news',
    status TEXT DEFAULT 'published',
    published_at TEXT DEFAULT (datetime('now')),
    created_at TEXT DEFAULT (datetime('now')),
    updated_at TEXT DEFAULT (datetime('now'))
);

CREATE TABLE IF NOT EXISTS settings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    setting_key TEXT NOT NULL UNIQUE,
    setting_value TEXT,
    setting_group TEXT DEFAULT 'general',
    updated_at TEXT DEFAULT (datetime('now'))
);

CREATE TABLE IF NOT EXISTS page_content (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    page_key TEXT NOT NULL UNIQUE,
    title TEXT,
    content TEXT,
    updated_at TEXT DEFAULT (datetime('now'))
);

CREATE TABLE IF NOT EXISTS contact_messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    subject TEXT,
    message TEXT NOT NULL,
    is_read INTEGER DEFAULT 0,
    created_at TEXT DEFAULT (datetime('now'))
);
");

// Admin user  (password: Admin@2024)
$db->exec("INSERT OR IGNORE INTO admin_users (username, password_hash, full_name, email) VALUES
('admin', '\$2y\$12\$BOt0Ou4.78EGrrhmDUvO/OoGjI2jaZzYJrEsZpXpUDALzKVU5QiaS', 'Site Administrator', 'admin@divinemercyfoundationfrbz.org')");

// Settings
$settings = [
    ['site_name',       'Divine Mercy Foundation',                       'general'],
    ['site_tagline',    'Bringing Hope. Sharing Love. Changing Lives.',   'general'],
    ['site_email',      'divinemercyfoundation@gmail.com',                'contact'],
    ['site_phone',      '+1 (512) 555-0199',                             'contact'],
    ['site_address',    'Texas, USA',                                     'contact'],
    ['donate_url',      'https://buy.stripe.com/9AQ00121AeUD9os288',      'general'],
    ['facebook_url',    '',                                               'social'],
    ['instagram_url',   '',                                               'social'],
    ['twitter_url',     '',                                               'social'],
    ['youtube_url',     '',                                               'social'],
    ['children_helped', '700+',                                           'stats'],
    ['countries_active','4',                                              'stats'],
    ['years_serving',   '9+',                                             'stats'],
    ['donors',          '500+',                                           'stats'],
    ['hero_title',      'Bringing Hope. Sharing Love. Changing Lives.',   'home'],
    ['hero_subtitle',   'Divine Mercy Foundation spreads joy, care, and opportunity to children and families across Cameroon, South Africa, Kenya, and Tanzania.', 'home'],
    ['mission_text',    'We are a nonprofit organization based in Texas, USA, that makes education accessible to the economically disadvantaged. We envision a world where the disadvantaged are able to reach their highest potential in keeping with their human dignity.', 'home'],
];
$ins = $db->prepare("INSERT OR IGNORE INTO settings (setting_key, setting_value, setting_group) VALUES (?,?,?)");
foreach ($settings as $row) $ins->execute($row);

// Page content
$pages = [
    ['about_mission',       'Our Mission',        'Help in correcting the marginalization suffered by a category of people in the African society: Orphans, Refugees, Children, youth and most especially young girls and the poorest of the society who do not have access to basic needs of life: food, shelter and education. Through the generosity of our donors, we try to educate and empower our dependents.'],
    ['about_story',         'Our Story',          'Divine Mercy Foundation is a Faith-based ministry that started in South Africa (Durban) and in Yaoundé, Cameroon. We are registered as a nonprofit organization based in Texas, USA. Making a charitable gift is an important and very personal decision. The satisfaction in giving to Divine Mercy Foundation comes in knowing that you are investing in the lives of economically disadvantaged children whose success in education would empower them to improve their quality of life in keeping with their human dignity. The Divine Mercy Foundation is a charitable organization, and all gifts and contributions are tax deductible to the extent allowed by law.'],
    ['about_vision',        'Our Vision',         'A world where every child, regardless of their circumstances, has access to education, healthcare, and the opportunity to reach their highest potential with full human dignity.'],
    ['education_intro',     'Child Education',    'Since its foundation, Divine Mercy Foundation has been involved in the education of young people who are abandoned, poor, orphans, or refugees. We assist children at various levels of education: day care, pre-school, primary, secondary, high school, and university. We choose one child per family in the area to spread opportunities across different families. Since 2016, with the assistance of donors, we have helped more than 700 children attend school in Durban (South Africa), Yaoundé (Cameroon), Kenya, and Tanzania. In Cameroon, the Foundation is planning to build a school.'],
    ['child_protection_text','Child Protection',  'Millions of children around the world are in danger of abuse, neglect, exploitation, and violence — at home, in school, in the community, or during unforeseen emergencies. Due to political instabilities and difficult living conditions, many children are orphans or have only one parent living in extreme poverty. Divine Mercy Foundation keeps the most vulnerable children safe from hunger, illiteracy, and harm.'],
    ['health_nutrition_text','Health & Nutrition', 'While life expectancy and child survival rates have improved in most developed countries, the mortality rate of children and adults due to malnutrition, cholera, and water-borne diseases in Cameroon remains very concerning. Divine Mercy Foundation offers orphans balanced, decent, and healthy meals daily. We also work toward creating conditions where drilling wells for drinkable water is possible, and we wish to extend this to rural areas throughout the region.'],
];
$ins = $db->prepare("INSERT OR IGNORE INTO page_content (page_key, title, content) VALUES (?,?,?)");
foreach ($pages as $row) $ins->execute($row);

// Sample news
$news = [
    ['Divine Mercy Foundation Sponsors 75 Children in Cameroon',
     'divine-mercy-sponsors-75-children-cameroon',
     'Divine Mercy Foundation is proud to announce the successful distribution of 75 school sponsorships to children in Cameroon as part of our ongoing mission to make education accessible.',
     '<p>Divine Mercy Foundation is proud to announce the successful distribution of <strong>75 school sponsorships</strong> to children in Cameroon. This initiative is part of our ongoing mission to make education accessible to the economically disadvantaged.</p><p>The sponsorships cover school fees, uniforms, textbooks, and basic school supplies for children across the Yaoundé region. Each child selected comes from a family living in extreme poverty, with priority given to orphans and single-parent households.</p><p>This achievement was made possible through the generous contributions of our donors and supporters from across the United States and around the world. Your generosity is literally changing the trajectory of these children\'s lives.</p><p>We extend our heartfelt gratitude to everyone who has supported this initiative. Together, we are proving that compassion has no borders.</p>',
     'activity', 'published', '2025-08-23 10:00:00'],

    ['Outreach: Distributing Books and Supplies at Ébomkop, Cameroon',
     'outreach-books-ebomkop-cameroon',
     'Distribution of books, textbooks, and school supplies to orphans and disadvantaged children at Ébomkop in Cameroon.',
     '<p>Divine Mercy Foundation recently completed an outreach program at <strong>Ébomkop, Cameroon</strong>, distributing books, textbooks, and essential school supplies to orphans and disadvantaged children in the community.</p><p>The outreach reached over 60 children who otherwise would not have had access to the basic materials needed for their education. Volunteers and local community leaders joined hands to ensure supplies reached every child in need.</p><p>Education is the most powerful tool we can give a child. A book today can change a life forever. We remain committed to expanding these outreach programs to more communities in Cameroon and beyond.</p>',
     'activity', 'published', '2023-10-07 08:00:00'],

    ['Helping Children with School Fees in South Africa',
     'helping-children-school-fees-south-africa',
     'Divine Mercy Foundation continues its commitment to supporting children with school fees in South Africa, ensuring that financial hardship is never a barrier to education.',
     '<p>Divine Mercy Foundation continues its vital work of supporting children with <strong>school fees in South Africa</strong>. Despite significant challenges in the region, we are committed to ensuring that no child is denied an education because of financial hardship.</p><p>Our program identifies the most vulnerable children — those from single-parent households, orphans, and children from families living below the poverty line — and provides direct financial support to cover their school fees.</p><p>Education has the power to break the cycle of poverty. Every child we help today becomes a beacon of hope for their community tomorrow. We thank our donors for making this possible.</p>',
     'news', 'published', '2024-03-15 09:00:00'],
];
$ins = $db->prepare("INSERT OR IGNORE INTO news (title, slug, excerpt, content, category, status, published_at) VALUES (?,?,?,?,?,?,?)");
foreach ($news as $row) $ins->execute($row);

echo "✅ Preview database initialised at " . DB_PATH . "\n";
