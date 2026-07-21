# Divine Mercy Foundation — Website

A PHP 8.2 website for Divine Mercy Foundation with a full admin panel.

## How to run

The **"Divine Mercy Foundation"** workflow starts the site. It uses PHP's built-in server with SQLite in preview mode — no MySQL needed on Replit.

```
cd divine-mercy-foundation && PREVIEW_MODE=1 php -S 0.0.0.0:5000
```

Open the preview pane to see the live site.

## Admin panel

Visit `/admin/` in the preview.

- **Username:** `admin`
- **Password:** `Admin@2024`

Change the password in Settings → Change Password after first login.

## Project layout

```
divine-mercy-foundation/   PHP website source
  config.php               DB + site config (PREVIEW_MODE=1 uses SQLite)
  preview.db               SQLite database (used in Replit preview)
  database.sql             MySQL schema (for production hosting)
  admin/                   Admin panel
  includes/                Shared PHP components (db, header, footer)
  assets/                  CSS, JS, images
artifacts/api-server/      Node.js proxy (used in production deployment only)
```

## Database

- **Preview (Replit):** SQLite at `divine-mercy-foundation/preview.db` — auto-used when `PREVIEW_MODE=1`
- **Production:** MySQL — configure credentials in `divine-mercy-foundation/config.php`

## Production deployment

For a live hosting provider (cPanel, VPS, etc.):
1. Set MySQL credentials in `config.php`
2. Import `database.sql` into your MySQL database
3. Upload `divine-mercy-foundation/` to your web root
4. Set `chmod 755 uploads/`

## User preferences
