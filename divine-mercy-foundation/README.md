# Divine Mercy Foundation — Website

A complete PHP + MySQL website with admin panel for Divine Mercy Foundation.

---

## 📁 File Structure

```
divine-mercy-foundation/
├── index.php              # Homepage
├── about.php              # About Us
├── programs.php           # Our Programs
├── activities.php         # Activities & News listing
├── activity.php           # Single news/activity post
├── contact.php            # Contact form
├── donate.php             # Donate page
├── 404.php                # 404 error page
├── config.php             # ⚠️  Database & site config (EDIT FIRST)
├── .htaccess              # Apache configuration
├── database.sql           # Database setup script (run once)
├── includes/              # Shared PHP components
│   ├── db.php             # Database connection & helper functions
│   ├── functions.php      # CSRF, flash messages, image upload
│   ├── header.php         # Site header & navigation
│   └── footer.php         # Site footer
├── admin/                 # Admin panel
│   ├── login.php          # Admin login
│   ├── logout.php         # Logout
│   ├── index.php          # Dashboard
│   ├── news.php           # Manage news & activities
│   ├── news-edit.php      # Add / Edit posts
│   ├── pages.php          # Edit page text content
│   ├── settings.php       # Site settings & social links
│   ├── messages.php       # Contact form submissions
│   └── includes/          # Admin-only components
├── assets/
│   ├── css/style.css      # Main stylesheet
│   ├── js/main.js         # Main JavaScript
│   └── images/logo.png    # Foundation logo
├── admin/assets/
│   ├── admin.css          # Admin panel stylesheet
│   └── admin.js           # Admin panel JavaScript
└── uploads/               # Uploaded images (auto-created)
```

---

## 🚀 Deployment Steps

### 1. Create the MySQL database

In your hosting control panel (cPanel), create a new MySQL database and user, then import `database.sql`:

```bash
mysql -u your_user -p your_database < database.sql
```

Or use phpMyAdmin → Import → select `database.sql`.

### 2. Edit `config.php`

Open `config.php` and update these values:

```php
define('DB_HOST', 'localhost');       // Usually 'localhost'
define('DB_NAME', 'divine_mercy_db'); // Your database name
define('DB_USER', 'your_db_username'); // Your database username
define('DB_PASS', 'your_db_password'); // Your database password
define('SITE_URL', 'https://yourdomain.com'); // Your domain (no trailing slash)
```

Also set `error_reporting(0)` and `display_errors = 0` for production.

### 3. Upload files

Upload all files to your web hosting `public_html` (or `www`) folder via FTP or your hosting file manager.

### 4. Set permissions

The `uploads/` directory needs write permissions:

```bash
chmod 755 uploads/
```

If it doesn't exist, create it:
```bash
mkdir uploads && chmod 755 uploads/
```

### 5. Log into the admin panel

Visit: `https://yourdomain.com/admin/login.php`

Default credentials:
- **Username:** `admin`
- **Password:** `Admin@2024`

**⚠️ Change the password immediately** in Settings → Change Password.

---

## 🎨 Color Scheme

| Role | Color |
|------|-------|
| Primary Red | `#C8102E` |
| Dark Navy | `#0D1F35` |
| Light Red | `#f5e6e9` |
| White | `#FFFFFF` |

---

## 🔧 Admin Panel Features

| Section | What you can do |
|---------|----------------|
| **Dashboard** | Overview stats, recent posts, unread messages |
| **News & Activities** | Create, edit, delete posts with images. Supports News / Activity / Announcement categories |
| **Page Content** | Edit text for About, Mission, Programs sections |
| **Messages** | Read and reply to contact form submissions |
| **Settings** | Site name, contact info, social links, stats, hero text, password change |

---

## 📱 Pages

| URL | Page |
|-----|------|
| `/` | Homepage with hero, stats, programs, latest news |
| `/about.php` | About, mission, vision, values |
| `/programs.php` | Education, Child Protection, Health & Nutrition |
| `/activities.php` | News & activities listing with pagination |
| `/activity.php?slug=...` | Individual post |
| `/contact.php` | Contact form |
| `/donate.php` | Donation page (links to Stripe) |
| `/admin/` | Admin panel |

---

## 🔒 Security Features

- CSRF protection on all forms
- Session-based authentication with secure cookies
- Password hashing (bcrypt)
- Session regeneration on login
- File upload type & size validation
- PHP execution blocked in uploads directory
- Sensitive files protected via `.htaccess`
- SQL injection prevention via PDO prepared statements
- XSS prevention via `htmlspecialchars()` throughout

---

## 📦 Requirements

- PHP 7.4+ (PHP 8.x recommended)
- MySQL 5.7+ or MariaDB 10.3+
- Apache with `mod_rewrite` enabled
- `file_uploads` enabled in PHP
