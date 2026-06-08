# Corporate Website & Admin Panel

**A modern, production-ready PHP application** for cooperatives and tech companies. Features complete content management, client portal, and dynamic configuration.

- **Tech Stack:** PHP 7.4+, MySQL/MariaDB, Bootstrap 5, Tailwind CSS, Alpine.js
- **Deployment:** cPanel/Shared Hosting
- **License:** Private

---

## 📋 Quick Reference

| Item | Details |
|------|---------|
| **Project** | Corporate Website & Admin Panel |
| **Database** | MySQL (cPanel) / SQLite (dev) |
| **Admin** | `{SITE_URL}/admin/` |
| **Setup Time** | 5 minutes on cPanel |

---

## 🚀 Getting Started

### For cPanel Deployment

**Quick Steps:**
```bash
1. Create MySQL database in cPanel
2. Clone: git clone {YOUR_REPO_URL}
3. Import: database.sql via phpMyAdmin
4. Configure: includes/config.php with DB credentials
5. chmod 755 uploads/ storage/ && find uploads/ storage/ -type f -exec chmod 644 {} \;
6. Visit: {SITE_URL}/admin/
```

### For Local Development

```bash
git clone {YOUR_REPO_URL}
cd {PROJECT_DIR}

# Create dev-config.php with your DB details
cat > includes/dev-config.php << EOF
<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'dev_db');
define('DB_USER', 'root');
define('DB_PASS', 'password');
EOF

# Database will auto-initialize on first access
```

---

## 📁 Project Structure

```
project/
├── admin/                  # Admin panel pages
│   ├── clients.php         # Client management
│   ├── news.php            # News/blog management
│   ├── pricing-table.php   # Pricing tiers
│   ├── partners.php        # Partner management
│   ├── team.php            # Team members
│   ├── settings.php        # Site settings
│   └── ...
├── api/                    # REST API endpoints
├── assets/                 # Static assets
│   ├── css/               # Theme, fonts, components
│   ├── images/            # Logo, icons, uploads
│   ├── js/                # Alpine.js, utilities
│   └── vendor/            # Lucide icons, datepicker
├── includes/              # Core library files
│   ├── config.php         # Database & site config
│   ├── db.php             # Database helpers
│   ├── sqlite-init.php    # DB schema (MySQL compatible)
│   ├── auth.php           # Authentication
│   ├── admin-layout.php   # Admin template
│   └── footer.php         # Footer component
├── lang/                  # Translations (Nepali/English)
├── public/                # Public API endpoints
├── uploads/               # User uploads (NOT in git)
├── storage/               # Cache, logs (NOT in git)
├── database.sql           # MySQL schema for cPanel
└── README.md              # This file
```

---

## 🔧 Configuration

### Environment (includes/config.php)

```php
// Database
define('DB_HOST',    'localhost');
define('DB_NAME',    'your_database');
define('DB_USER',    'your_username');
define('DB_PASS',    'your_password');

// Site
define('SITE_URL',   'https://yourdomain.com');
define('SITE_NAME',  'Your Company Name');

// Uploads
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
define('UPLOAD_URL', SITE_URL . '/uploads/');
```

### Local Dev Override (includes/dev-config.php)

Create this file locally — **never commit to git**:

```php
<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'dev_db');
define('DB_USER', 'root');
define('DB_PASS', 'your_password');
define('SITE_URL', 'http://localhost:5000');
```

---

## 📊 Database Schema

Auto-initializes on first access. Tables include:

- **Core:** users, site_settings, team_members
- **Content:** news, faqs, services, products, pricing_plans
- **Business:** clients, partners, testimonials, portfolio
- **Leads:** contact_submissions, demo_requests
- **Admin:** job_listings, announcements

See **[database.sql](./database.sql)** for complete schema.

---

## 🔐 Admin Panel Features

### Content Management
- **News/Blog** - Write, publish, analytics
- **Testimonials** - Customer quotes with ratings
- **Portfolio** - Case studies and project showcase
- **Services & Products** - Detailed service/product info
- **Pricing Plans** - Multi-tier pricing with features

### Business Management
- **Clients** - CRM for client organizations
- **Partners** - Channel/technology partners
- **Team Members** - Board & management team
- **Contact Leads** - Submissions from contact forms
- **Demo Requests** - Product demo requests

### Settings
- **Company Details** - Name, contact, location
- **Site Configuration** - Taglines, branding
- **Pricing Comparison** - Feature matrix editor
- **Users** - Admin user management

---

## 🌐 Public Pages

| Page | Route | Features |
|------|-------|----------|
| Homepage | `/` | Hero, services, stats, testimonials |
| About Us | `/about.php` | Company story, team, mission |
| Services | `/services.php` | Service cards with details |
| Products | `/products.php` | Product showcase with pricing |
| Pricing | `/pricing.php` | Pricing comparison table |
| Team | `/team.php` | Team members (board + management) |
| Partners | `/partners.php` | Client, partner, investor logos |
| Portfolio | `/portfolio.php` | Case studies & project showcase |
| News/Blog | `/news.php` | News articles, categories |
| FAQs | `/faq.php` | FAQ accordion |
| Careers | `/careers.php` | Job listings |
| Contact | `/contact.php` | Contact form |

---

## 🛠 Development

### Database Migrations

Auto-migrations run on every request via `sqliteMigrate()`:

```php
// In includes/sqlite-init.php
function sqliteMigrate(PDO $pdo): void {
    $migrationSql = [
        "ALTER TABLE team_members ADD COLUMN category VARCHAR(50) DEFAULT 'management'",
    ];
    // Safely execute migrations
}
```

Add new migrations here — no manual SQL needed.

### Adding New Admin Pages

1. **Create form:** `admin/new-feature.php`
   - Use existing pages as template
   - Include `admin-layout.php` for styling

2. **Add database:** Add table to `database.sql` & `sqlite-init.php`

3. **Link in menu:** Edit `includes/admin-layout.php` menu array

4. **Test locally:** `php -S localhost:5000`

### Frontend Components

Using **Tailwind CSS + Bootstrap 5**:

```php
<!-- Card component -->
<div class="card shadow-sm border-0">
  <div class="card-body">
    <h5 class="card-title">Title</h5>
    <p class="card-text">Content</p>
  </div>
</div>

<!-- Form input -->
<input type="text" class="form-input" placeholder="Enter text">

<!-- Button -->
<button class="btn btn-primary btn-sm">Action</button>
```

---

## 📤 Deployment

### Via Git (Recommended)

```bash
# On cPanel server
cd public_html/{PROJECT_DIR}
git pull origin main           # Pull latest changes

# If database.sql changed:
mysql -u user -p db < database.sql
```

### Via FTP

1. Download: `git clone {YOUR_REPO_URL}`
2. Upload to: `public_html/{PROJECT_DIR}/`
3. Import database in phpMyAdmin
4. chmod uploads & storage directories

---

## 🔒 Security

- ✅ Prepared statements prevent SQL injection
- ✅ Password hashing (bcrypt)
- ✅ Session security with HTTPOnly cookies
- ✅ CSRF tokens on forms
- ✅ Rate limiting on auth endpoints
- ✅ Never commit DB passwords (dev-config.php in .gitignore)

---

## 🐛 Troubleshooting

### "Connection to database failed"
```
Check includes/config.php credentials match cPanel MySQL setup
```

### "Call to undefined function"
```
Ensure includes/ files are included: require_once __DIR__ . '/includes/db.php';
```

### "Permission denied" on uploads
```
chmod 755 uploads/ storage/cache/ storage/logs/
find uploads/ storage/ -type f -exec chmod 644 {} \;
```

### "Can't connect to MySQL socket"
```
In includes/config.php, set correct DB_HOST and DB_SOCKET for your server
```

---

## 📄 License

Private. All rights reserved.

---

**Last Updated:** 2026-06-08  
**Status:** Production Ready ✅  
**Version:** 1.2.0
