# 🛠️ Site Setup Guide

## Step 1 — APP_SECRET (Fix "Configuration Error")

Open **`includes/config.php`** and find this line (around line 42):

```php
define('APP_SECRET_KEY', '');   // <-- paste your key between the quotes
```

Paste a strong random key between the quotes. Use one of these ready-made keys:

> **Copy one of these (all are unique and safe):**

```
2b1ef9a6d8ebd35717297cf300f812a6347734f07af63404f1951bf522f0f011
```

After editing it should look like:
```php
define('APP_SECRET_KEY', '2b1ef9a6d8ebd35717297cf300f812a6347734f07af63404f1951bf522f0f011');
```

Save the file. Error disappears instantly.

---

## Step 2 — Database Settings

In the same file `includes/config.php`, update:

```php
define('DB_NAME', 'your_database_name');   // ← cPanel database name
define('DB_USER', 'your_database_user');   // ← cPanel database username
define('DB_PASS', '');                     // ← database password
```

Your cPanel database name/user usually looks like: `username_dbname`

---

## Step 3 — Site URL

```php
define('SITE_URL', 'https://example.com');   // ← your real domain
```

No trailing slash. If installed in subfolder: `https://yourdomain.com/mysite`

---

## Step 4 — Upload the Files

Upload everything via **cPanel File Manager** or FTP to your `public_html` folder.

---

## Done! ✅

Visit your site. If you still see errors, check cPanel → Error Logs.
