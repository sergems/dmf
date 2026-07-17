<?php
require_once dirname(__DIR__) . '/config.php';

function get_db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        try {
            if (DB_DRIVER === 'sqlite') {
                $dsn = 'sqlite:' . DB_PATH;
                $pdo = new PDO($dsn, null, null, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
                $pdo->exec('PRAGMA journal_mode=WAL; PRAGMA foreign_keys=ON;');
            } else {
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
                $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
            }
        } catch (PDOException $e) {
            die('<div style="font-family:sans-serif;padding:2rem;background:#fff0f0;border:1px solid #c00;border-radius:8px;max-width:600px;margin:3rem auto;">
                <h2 style="color:#c00">Database Connection Error</h2>
                <p>Could not connect to the database. Please check your <code>config.php</code> settings.</p>
                <p style="color:#666;font-size:.85rem;">' . htmlspecialchars($e->getMessage()) . '</p>
            </div>');
        }
    }
    return $pdo;
}

function get_setting(string $key, string $default = ''): string {
    static $cache = [];
    if (isset($cache[$key])) return $cache[$key];
    $pdo = get_db();
    $stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
    $stmt->execute([$key]);
    $row = $stmt->fetch();
    $cache[$key] = $row ? (string)$row['setting_value'] : $default;
    return $cache[$key];
}

function get_page_content(string $key): array {
    $pdo = get_db();
    $stmt = $pdo->prepare("SELECT * FROM page_content WHERE page_key = ?");
    $stmt->execute([$key]);
    return $stmt->fetch() ?: ['title' => '', 'content' => ''];
}

function get_news_list(int $limit = 10, int $offset = 0, string $category = ''): array {
    $pdo = get_db();
    $where = "status = 'published'";
    $params = [];
    if ($category) {
        $where .= " AND category = ?";
        $params[] = $category;
    }
    $params[] = $limit;
    $params[] = $offset;
    $stmt = $pdo->prepare("SELECT * FROM news WHERE $where ORDER BY published_at DESC LIMIT ? OFFSET ?");
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function get_news_by_slug(string $slug): ?array {
    $pdo = get_db();
    $stmt = $pdo->prepare("SELECT * FROM news WHERE slug = ? AND status = 'published'");
    $stmt->execute([$slug]);
    $row = $stmt->fetch();
    return $row ?: null;
}

function count_news(string $category = ''): int {
    $pdo = get_db();
    $where = "status = 'published'";
    $params = [];
    if ($category) {
        $where .= " AND category = ?";
        $params[] = $category;
    }
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM news WHERE $where");
    $stmt->execute($params);
    return (int)$stmt->fetchColumn();
}

function slugify(string $text): string {
    $text = mb_strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

function h(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function excerpt(string $text, int $len = 160): string {
    $text = strip_tags($text);
    if (mb_strlen($text) <= $len) return $text;
    return mb_substr($text, 0, $len) . '…';
}

function format_date(string $date): string {
    return date('F j, Y', strtotime($date));
}
