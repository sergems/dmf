# Deploying Divine Mercy Foundation to cPanel Shared Hosting

Follow these steps in order. The whole process takes about 30–60 minutes depending on your internet speed (the image folders are large).

---

## Before You Start — What You Need

- [ ] cPanel login credentials for your shared hosting account
- [ ] Your domain name (e.g. `https://divinemercyfoundationfrbz.org`)
- [ ] FileZilla (free FTP client) → https://filezilla-project.org
- [ ] The project downloaded as a ZIP from Replit

---

## Step 1 — Download the Project from Replit

1. In Replit, click the **three-dot menu (⋯)** at the top of the file tree
2. Click **Download as ZIP**
3. Unzip it on your computer
4. Inside the unzipped folder, locate the **`divine-mercy-foundation/`** subfolder — this is the only folder you need

---

## Step 2 — Create the MySQL Database in cPanel

1. Log in to **cPanel**
2. Go to **MySQL Databases**
3. Under "Create New Database", type a name (e.g. `dmf`) → click **Create Database**
4. Under "MySQL Users → Add New User":
   - Username: e.g. `dmfuser`
   - Password: use a strong password — **write it down**
   - Click **Create User**
5. Under "Add User to Database":
   - Select the user and database you just created
   - Click **Add** → tick **ALL PRIVILEGES** → click **Make Changes**
6. Note these four values — you'll need them in Step 4:

```
DB Host:     localhost
DB Name:     yourCpanelPrefix_dmf
DB User:     yourCpanelPrefix_dmfuser
DB Password: (the password you set)
```

> **Note:** cPanel automatically prepends your cPanel username to database and user names (e.g. `johnsmith_dmf`). The full name is shown on the MySQL Databases page.

---

## Step 3 — Import the Database Schema

1. In cPanel, open **phpMyAdmin**
2. In the left panel, click your new database (e.g. `johnsmith_dmf`)
3. Click the **Import** tab at the top
4. Click **Choose File** → select `divine-mercy-foundation/database.sql` from your computer
5. Leave all settings as default → click **Go**
6. You should see a green success message. This creates all the tables.

---

## Step 4 — Edit `config.php`

Open `divine-mercy-foundation/config.php` in a text editor (Notepad++, VS Code, etc.).

Find the **production block** (the `else` section) and fill in your values:

```php
define('DB_HOST',    'localhost');
define('DB_NAME',    'johnsmith_dmf');      // ← your full database name
define('DB_USER',    'johnsmith_dmfuser');  // ← your full database username
define('DB_PASS',    'YourStrongPassword'); // ← your database password
define('DB_CHARSET', 'utf8mb4');
```

Find the `SITE_URL` line and set your domain:

```php
define('SITE_URL', 'https://yourdomain.com'); // ← no trailing slash
```

Turn off error display for production (find these two lines and change them):

```php
error_reporting(0);
ini_set('display_errors', 0); // change 1 to 0
```

**Save the file.**

---

## Step 5 — Upload Files via FTP

FTP is the fastest way to upload the image folders. The File Manager inside cPanel is too slow for hundreds of images.

### 5a — Connect with FileZilla

1. Open **FileZilla**
2. Go to **File → Site Manager → New Site**
3. Fill in:
   - **Host:** your domain (e.g. `ftp.yourdomain.com`)
   - **Protocol:** FTP or SFTP (check what your host provides)
   - **Logon Type:** Normal
   - **User / Password:** your cPanel FTP credentials
4. Click **Connect**

### 5b — Navigate to the right folder

- On the **right panel** (remote server), navigate to `public_html/`
  - If deploying to a subdomain, navigate to that subdomain's folder instead

### 5c — Upload everything

- On the **left panel** (your computer), navigate into `divine-mercy-foundation/`
- Select **all files and folders** inside it (Ctrl+A)
- Drag them to the right panel (into `public_html/`)

This uploads the contents of `divine-mercy-foundation/` directly into `public_html/` — so you get `public_html/index.php`, `public_html/config.php`, etc.

> **The image folders are large.** Let FileZilla run — it will queue and transfer everything automatically. Do not close it until it finishes.

---

## Step 6 — Set Folder Permissions

Some folders need write permission so PHP can save uploaded files.

1. In cPanel → **File Manager** → navigate to `public_html/`
2. Right-click the **`uploads/`** folder → **Change Permissions**
3. Set to **755** → click **Change Permissions**
4. Do the same for any subfolders inside `uploads/`:
   - `uploads/orphanage/`
   - `uploads/reports/`

---

## Step 7 — Set Up the Admin Account

1. Visit `https://yourdomain.com/admin/login.php`
2. Log in with the default credentials:
   - **Username:** `admin`
   - **Password:** `Admin@2024`
3. Go to **Settings → Change Password** and set a strong password immediately
4. Fill in your site settings:
   - Site Name, Contact Email, Phone Numbers
   - Donate URL (your Stripe / PayPal link)
   - Facebook, Instagram, YouTube links

---

## Step 8 — Re-enter Orphanage Albums

The photo albums (August & February 2025, November 2025, etc.) were stored in the local SQLite database — they do **not** transfer automatically to MySQL.

You need to recreate them through the admin panel:

1. Go to **Admin → Orphanage**
2. Under **Photo Albums**, click **Add New Album** for each time period
3. For each album, upload the photos from your computer
   - The image files are in: `assets/images/wp-uploads/YYYY/MM/`
   - e.g. `assets/images/wp-uploads/2026/02/dmf-1-1024x576.jpeg`

> **Tip:** You can also use "Add photo by URL" to link to images already uploaded on your server instead of re-uploading them.

---

## Step 9 — Test the Site

Go through this checklist in your browser:

- [ ] Homepage loads at `https://yourdomain.com`
- [ ] Navigation links all work
- [ ] Orphanage page shows photos
- [ ] Gallery page loads and lightbox opens when clicking an image
- [ ] Contact form submits (check Admin → Messages)
- [ ] Admin panel loads at `/admin/login.php`
- [ ] Uploading a news post with an image works
- [ ] Donate button links to the correct page

---

## Step 10 — Remove Sensitive Files (Security)

After everything is confirmed working, delete these files from the server:

| File | Why |
|------|-----|
| `init-preview-db.php` | Sets up the SQLite preview database — not needed in production |
| `seed-orphanage.php` | Inserts test data — not needed in production |
| `preview.db` | The local SQLite database — not used in production |

You can delete them in cPanel → File Manager, or via FTP.

---

## Troubleshooting

| Problem | Fix |
|---------|-----|
| Blank white page | Turn `display_errors` back to `1` temporarily in `config.php` to see the error |
| 404 on all pages | Check that `.htaccess` uploaded correctly and that mod_rewrite is enabled on your host |
| Database connection error | Double-check the DB name, user, and password in `config.php` — remember cPanel adds a prefix |
| Images not showing | Check that the `assets/` folder uploaded fully; large FTP transfers sometimes miss files |
| Can't write uploads | Set `uploads/` and its subfolders to permission `755` |
| Admin login fails | The default password is `Admin@2024` — if that fails, check that `database.sql` imported correctly |

---

## Optional — Point Your Domain

If your domain isn't already pointing to this hosting:

1. In your domain registrar (GoDaddy, Namecheap, etc.), update the **nameservers** to your host's nameservers
2. Or update the **A record** to point to your server's IP address (find the IP in cPanel → **Server Information**)
3. DNS propagation takes up to 48 hours, but usually under 2 hours

---

*Site: Divine Mercy Foundation | Stack: PHP 8+ · MySQL · Apache*
