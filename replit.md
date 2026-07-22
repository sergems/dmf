# Divine Mercy Foundation — Website

A PHP + MySQL/SQLite nonprofit website for Divine Mercy Foundation with a public-facing site and admin panel.

## Stack
- **Language:** PHP 8.2
- **Database:** MySQL (production) / SQLite (preview/dev)
- **Server:** PHP built-in dev server (preview), Apache (production)
- **Frontend:** Plain HTML/CSS/JS (no framework)

## How to run
The workflow `Divine Mercy Foundation` starts the site in preview mode:
```
cd /home/runner/workspace/divine-mercy-foundation && PREVIEW_MODE=1 php -S 0.0.0.0:5000
```
`PREVIEW_MODE=1` switches the database to SQLite (`preview.db`) so no MySQL credentials are needed during development.

## Key files
- `config.php` — database + site config; update for production MySQL
- `database.sql` — schema to import into MySQL for production
- `includes/db.php` — database connection and helpers
- `admin/` — admin panel (login, news, settings, messages)
- `assets/` — CSS, JS, images

## Admin panel
URL: `/admin/login.php`
Default credentials: `admin` / `Admin@2024` (**change on first login**)

## Production deployment notes
- Set `PREVIEW_MODE` env var to `0` (or remove it)
- Fill in MySQL credentials in `config.php`
- Run `database.sql` to create the schema
- Set `error_reporting(0)` and `display_errors = 0` in `config.php`
- Ensure `uploads/` directory is writable (`chmod 755`)

## User preferences
