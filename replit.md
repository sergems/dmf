# Divine Mercy Foundation Website

A complete PHP + MySQL nonprofit website with a public-facing site and an admin panel for Divine Mercy Foundation.

## Run & Operate

- **Preview (SQLite, no DB setup needed):** `cd divine-mercy-foundation && PREVIEW_MODE=1 php -S 0.0.0.0:5000`
  - This is the default Replit workflow. Just hit **Run**.
  - Uses `divine-mercy-foundation/preview.db` (SQLite) — no MySQL required.
- **Production:** Requires MySQL. Update `divine-mercy-foundation/config.php` with your DB credentials, then import `divine-mercy-foundation/database.sql`.

## Admin Panel

- URL: `/admin/login.php`
- Default credentials are seeded by `init-preview-db.php` (preview mode only).

## Stack

- PHP 8.2, SQLite (preview) / MySQL (production)
- PDO for all DB queries (prepared statements)
- Session-based admin auth with bcrypt passwords
- Vanilla JS + CSS (no build step)

## Where things live

- `divine-mercy-foundation/config.php` — database & site config (edit for production)
- `divine-mercy-foundation/database.sql` — MySQL schema + seed data (run once for production)
- `divine-mercy-foundation/init-preview-db.php` — initialises the SQLite preview DB
- `divine-mercy-foundation/includes/` — shared PHP components (db, functions, header, footer)
- `divine-mercy-foundation/admin/` — admin panel (login, dashboard, news, messages, settings)
- `divine-mercy-foundation/assets/` — CSS, JS, images, documents

## Pages

| URL | Description |
|-----|-------------|
| `/` | Homepage |
| `/about.php` | About the foundation |
| `/programs.php` | Programs overview |
| `/activities.php` | News & activities listing |
| `/contact.php` | Contact form |
| `/donate.php` | Donation page |
| `/admin/` | Admin panel |

## Architecture decisions

- Preview mode (`PREVIEW_MODE=1`) swaps MySQL for SQLite so the site runs on Replit without any external database.
- All DB access goes through `get_db()` in `includes/db.php` — both SQLite and MySQL use the same PDO interface.
- CSRF tokens, bcrypt passwords, and `htmlspecialchars()` throughout for security.

## User preferences

_Populate as needed._

## Gotchas

- Run `php init-preview-db.php` (from the `divine-mercy-foundation/` directory) to reset the preview SQLite database.
- The `.htaccess` file is for Apache; the PHP built-in server used in preview mode does not support mod_rewrite, so URL rewriting is not active in preview.
- For production, set `error_reporting(0)` and `display_errors = 0` in `config.php`.
