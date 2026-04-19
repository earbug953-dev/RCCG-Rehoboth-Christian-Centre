# 🕊️ RCCG Rehoboth Christian Centre — Installation Guide

Follow these steps carefully to get the site running on your server or local machine.

---

## ✅ Prerequisites

Make sure you have the following installed:

| Tool        | Minimum Version |
|-------------|----------------|
| PHP         | 8.1+           |
| Composer    | 2.x            |
| MySQL       | 5.7+ or 8.x    |
| Node.js     | 18+            |
| Laravel CLI | 11.x (via Composer) |

---

## 📦 Step 1 — Create a Fresh Laravel Project

This scaffold contains only the **custom files** for your church site.
You must first create a standard Laravel 11 project, then drop these files in.

```bash
# Create a new Laravel 11 project
composer create-project laravel/laravel rccg-rehoboth

cd rccg-rehoboth
```

---

## 📁 Step 2 — Copy Scaffold Files

Copy all files from this download into your new Laravel project folder.
Overwrite any existing files when prompted.

```bash
# Example (Linux/Mac) — replace /path/to/download with your actual path
cp -r /path/to/download/rccg-rehoboth/* /path/to/rccg-rehoboth/
```

Files to copy:
- `app/` — Models and Controllers
- `database/` — Migrations and Seeders
- `resources/views/` — All Blade templates
- `routes/web.php` — All routes
- `composer.json` — Dependencies reference
- `.env.example` — Environment template

---

## 🔧 Step 3 — Configure Environment

```bash
# Copy env file
cp .env.example .env

# Open .env and set your database credentials:
nano .env
```

Edit these lines in `.env`:
```
APP_NAME="RCCG Rehoboth Christian Centre"
APP_URL=http://localhost

DB_DATABASE=rccg_rehoboth
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

---

## 🗄️ Step 4 — Create the Database

Log in to MySQL and create the database:

```sql
CREATE DATABASE rccg_rehoboth CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

## 🔑 Step 5 — Generate App Key & Run Migrations

```bash
# Generate application key
php artisan key:generate

# Run all migrations (creates all tables)
php artisan migrate

# Seed the default admin user
php artisan db:seed --class=AdminSeeder
```

This creates:
- `sermons` table
- `events` table
- `bulletins` table
- `galleries` + `photos` tables
- `blogs` table
- Adds `role` column to `users` table
- Default admin user: **admin@rccgrehoboth.org / Admin@1234**

---

## 🔗 Step 6 — Create Storage Symlink

```bash
php artisan storage:link
```

This makes uploaded files (sermons, photos, PDFs) accessible from the browser.

---

## 🚀 Step 7 — Run the Development Server

```bash
php artisan serve
```

Visit: **http://localhost:8000**

Admin panel: **http://localhost:8000/admin/login**

---

## 🔐 Default Admin Credentials

| Field    | Value                     |
|----------|---------------------------|
| Email    | admin@rccgrehoboth.org    |
| Password | Admin@1234                |

> ⚠️ **Change this password immediately after first login!**

---

## 🌐 Production Deployment (cPanel / Shared Hosting)

1. Upload files to your hosting via FTP or Git
2. Set the document root to the `public/` folder
3. Set `.env` variables for your live database and `APP_URL`
4. Set `APP_DEBUG=false` and `APP_ENV=production`
5. Run: `php artisan config:cache && php artisan route:cache`
6. Run: `php artisan storage:link`

---

## 📂 Key Directory Overview

```
app/
  Http/Controllers/
    Admin/            ← Sermon, Event, Bulletin, Gallery, Blog CRUD
    Auth/             ← Admin login/logout
  Models/             ← Sermon, Event, Bulletin, Gallery, Photo, Blog, User

database/
  migrations/         ← All table schemas
  seeders/            ← AdminSeeder (default admin user)

resources/views/
  layouts/
    app.blade.php     ← Public site layout (nav + footer)
    admin.blade.php   ← Admin panel layout (sidebar)
  public/             ← Public page views
  admin/              ← Admin panel views

routes/
  web.php             ← All public + admin routes
```

---

## 🎨 Customisation Tips

- **Church name / address**: Edit `resources/views/layouts/app.blade.php` (footer section)
- **Colours**: The theme uses navy `#1e3a5f` and gold `#c9a84c` — change Tailwind config in layouts
- **Hero text**: Edit `resources/views/public/home.blade.php`
- **Scripture banner**: Edit the gold strip section in `home.blade.php`
- **Social media links**: Add to footer in `layouts/app.blade.php`
- **Max upload size**: Edit `upload_max_filesize` and `post_max_size` in your `php.ini`

---

## 🆘 Troubleshooting

| Issue | Fix |
|-------|-----|
| Uploaded files not showing | Run `php artisan storage:link` |
| 500 error on login | Check `APP_KEY` is set in `.env` |
| Class not found errors | Run `composer dump-autoload` |
| Migration errors | Check DB credentials in `.env` |
| Permission errors on storage | Run `chmod -R 775 storage bootstrap/cache` |
