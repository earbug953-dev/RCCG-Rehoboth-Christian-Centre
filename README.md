# RCCG Rehoboth Christian Centre, Chorley — Church Website

A Laravel + Blade church content management website.

---

## Features

- 🎤 **Sermons** — Upload audio/video sermons with title, preacher, date, scripture
- 📅 **Events** — Create and manage church event announcements
- 📄 **Bulletins** — Upload weekly PDF bulletins/newsletters
- 🖼️ **Gallery** — Photo gallery organised by albums
- ✍️ **Blog / Devotionals** — Write and publish posts
- 🔐 **Admin Panel** — Secure admin area for pastor/staff only

---

## Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL / PostgreSQL
- Laravel 11

---

## Installation

```bash
# 1. Clone or extract this project
cd rccg-rehoboth

# 2. Install PHP dependencies
composer install

# 3. Copy environment file
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Configure .env with your database credentials
#    DB_DATABASE=rccg_rehoboth
#    DB_USERNAME=your_db_user
#    DB_PASSWORD=your_db_password

# 6. Run migrations
php artisan migrate

# 7. Seed the default admin user
php artisan db:seed --class=AdminSeeder

# 8. Create storage symlink (for file uploads)
php artisan storage:link

# 9. Serve the application
php artisan serve
```

---

## Default Admin Credentials

After seeding, log in at `/admin/login`:

- **Email:** admin@rccgrehoboth.org
- **Password:** Admin@1234

> ⚠️ Change these immediately after first login via your database or a profile update route.

---

## Directory Structure (Key Files)

```
app/
  Http/Controllers/
    Admin/          ← Admin CRUD controllers
    Auth/           ← Admin login/logout
  Models/           ← Eloquent models
database/
  migrations/       ← All table schemas
resources/views/
  layouts/          ← app.blade.php (public) + admin.blade.php
  public/           ← Public-facing pages
  admin/            ← Admin panel pages
routes/
  web.php           ← All routes
```

---

## File Upload Storage

All uploaded files (sermons, bulletins, photos) are stored in `storage/app/public/`
and served via the `storage` symlink. Ensure `php artisan storage:link` is run.

---

## Customisation

- Update church name/logo in `resources/views/layouts/app.blade.php`
- Update colours in the Tailwind classes (primary = navy `#1e3a5f`, accent = gold)
- Add social media links in the footer partial
