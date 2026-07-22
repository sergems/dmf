# Divine Mercy Foundation — Website

A complete PHP + SQLite/MySQL website with admin panel for Divine Mercy Foundation, a 501(c)(3) nonprofit based in Texas, USA.

## Stack

- **Language:** PHP 8.2
- **Database:** SQLite (preview/dev) or MySQL (production)
- **Frontend:** Plain HTML/CSS/JS (no build step)
- **Admin panel:** `/admin/` — PHP session auth

## How to Run

The workflow **"Divine Mercy Foundation"** starts the PHP built-in dev server on port 5000:

```
cd /home/runner/workspace/divine-mercy-foundation && PREVIEW_MODE=1 php -S 0.0.0.0:5000
```

`PREVIEW_MODE=1` switches the database driver to SQLite (`preview.db`). No MySQL credentials are needed for local development.

### First-time setup

If `preview.db` doesn't exist, initialise it once:

```
cd divine-mercy-foundation && php init-preview-db.php
```

This creates all tables and seeds sample data.

### Admin login (preview)

- URL: `/admin/`
- Username: `admin`
- Password: `Admin@2024`

## Project Layout

```
divine-mercy-foundation/
├── index.php              # Homepage
├── about.php / about-*.php
├── activities.php / activity.php
├── donate.php / contact.php
├── education-fund.php / orphanage-*.php
├── admin/                 # Admin panel (login-protected)
├── assets/css|js|images/  # Static assets
├── includes/              # Shared PHP: db.php, header, footer, functions
├── config.php             # DB + site config (preview/production switch)
├── database.sql           # MySQL schema (for production setup)
├── init-preview-db.php    # SQLite seed script (dev only)
└── preview.db             # SQLite database (git-ignored, created on first run)
```

## Production Deployment

For production (Apache + MySQL):
1. Set `PREVIEW_MODE` to anything other than `1` (or remove it).
2. Fill in `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS` in `config.php`.
3. Import `database.sql` into MySQL.
4. Set `SITE_URL` in `config.php`.
5. Ensure `mod_rewrite` is enabled for `.htaccess` routing.

## User Preferences

_No preferences recorded yet._
