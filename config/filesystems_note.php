<?php
/**
 * RCCG Rehoboth — Filesystem config note
 *
 * In your Laravel project's config/filesystems.php, ensure the 'public' disk is configured:
 *
 *  'public' => [
 *      'driver'     => 'local',
 *      'root'       => storage_path('app/public'),
 *      'url'        => env('APP_URL').'/storage',
 *      'visibility' => 'public',
 *      'throw'      => false,
 *  ],
 *
 * Then run: php artisan storage:link
 *
 * This creates a symlink from public/storage → storage/app/public
 * so all uploaded files (sermons, bulletins, gallery, blog covers) are accessible via URL.
 */
