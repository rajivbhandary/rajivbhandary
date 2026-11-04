# Perks Properties website

Source for [perksproperties.in](https://perksproperties.in): property listings for sale and rent,
fractional ownership (FRE) offers, a blog, and the control panel the team uses to manage them.

- **Stack:** Laravel 13, PHP 8.3+, MySQL/MariaDB, Blade templates with Bootstrap 4.
- **Public site:** `resources/views/frontend`, styled by `public/assets/frontend/css/perks.css`
  and scripted by `public/assets/frontend/js/perks.js`.
- **Control panel:** `/control-panel` (Metronic admin template), `resources/views/admin`.

## Requirements

- PHP 8.3 or newer with `pdo_mysql`, `mbstring`, `gd`, `fileinfo`, `zip`, `intl`
- Composer 2
- MySQL 8 or MariaDB 10.6+
- Apache with `mod_rewrite` (and ideally `mod_deflate` and `mod_expires`) or Nginx

## Deploying this version to the live server

This release moves the site from Laravel 7 to Laravel 13, so the server must run **PHP 8.3+**.
Most cPanel hosts let you switch PHP version per domain ("Select PHP Version" / "MultiPHP Manager").

1. **Back up** the database and the `storage/app/public` folder (uploaded photos).
2. Upload the code (or `git pull`), keeping the existing `.env` and `storage/app/public`.
3. Install dependencies: `composer install --no-dev --optimize-autoloader`
4. Update `.env` (compare with `.env.example`):
   - `APP_ENV=production` and `APP_DEBUG=false`
   - `GOOGLE_ANALYTICS_ID=G-...` (the old `UA-` tag stopped working in 2023)
5. Run the database changes: `php artisan migrate --force`
   (adds contact fields to Site Settings and makes enquiry email/city/state optional).
6. Rebuild caches: `php artisan optimize:clear && php artisan optimize`
7. Make sure `public/storage` points at `storage/app/public`: `php artisan storage:link`
8. Log in to the control panel, open **Site Settings** and fill in the contact phone, WhatsApp
   number and email. Until these are set, the site shows only the enquiry form (no Call or
   WhatsApp buttons).

### One-time security actions

- **Change the super-admin password** if it was ever `abcd1234` (it was hardcoded in an old
  migration).
- Delete any accounts created through the old public `/register` page that should not have
  control-panel access (*Users* in the control panel; they have the `author` role).
- Check `storage/app/public` for any file that is not an image (for example `.php`, `.phtml`,
  `.html`, `.svg`) and delete it: uploads were not restricted before this release.
- In Google Cloud Console, delete or restrict the three old Google Maps API keys that were
  published in the page source; the site no longer needs any key.

## Local development

```bash
cp .env.example .env            # then set DB_* and APP_ENV=local, APP_DEBUG=true
composer install
php artisan key:generate
php artisan migrate --seed      # demo data, only seeded when APP_ENV is local or testing
php artisan storage:link
php artisan serve
```

## Tests

Feature tests use a separate MySQL database named `perks_test` (see `phpunit.xml`):

```bash
vendor/bin/phpunit
```

They cover access control, uploads, the enquiry form, search, listing create/edit and the
public pages.
