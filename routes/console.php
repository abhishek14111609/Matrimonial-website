<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('photos:audit {--limit=0}', function () {
    $limit = (int) $this->option('limit');

    $query = DB::table('users')
        ->select(['id', 'name', 'photo'])
        ->whereNotNull('photo')
        ->whereRaw("TRIM(photo) <> ''")
        ->orderBy('id');

    if ($limit > 0) {
        $query->limit($limit);
    }

    $rows = $query->get();

    if ($rows->isEmpty()) {
        $this->warn('No user photo paths found in DB.');
        return;
    }

    $missingCount = 0;

    $this->line('id | name | raw_photo | normalized_path | public_exists | private_exists | external_url');

    foreach ($rows as $row) {
        $rawPhoto = trim((string) $row->photo);
        $normalized = ltrim($rawPhoto, '/');
        $isExternal = false;

        if (filter_var($rawPhoto, FILTER_VALIDATE_URL)) {
            $urlHost = (string) parse_url($rawPhoto, PHP_URL_HOST);
            $appHost = (string) parse_url((string) config('app.url'), PHP_URL_HOST);
            $isExternal = $urlHost !== '' && $appHost !== '' && strcasecmp($urlHost, $appHost) !== 0;
            $normalized = ltrim((string) parse_url($rawPhoto, PHP_URL_PATH), '/');
        }

        if (str_starts_with($normalized, 'storage/')) {
            $normalized = substr($normalized, 8);
        }

        $existsPublic = $normalized !== '' && Storage::disk('public')->exists($normalized);
        $existsPrivate = $normalized !== '' && Storage::disk('local')->exists($normalized);

        if (! $existsPublic) {
            $missingCount++;
        }

        $this->line(sprintf(
            '%d | %s | %s | %s | %s | %s | %s',
            (int) $row->id,
            str_replace('|', '/', (string) $row->name),
            str_replace('|', '/', $rawPhoto),
            $normalized,
            $existsPublic ? 'yes' : 'no',
            $existsPrivate ? 'yes' : 'no',
            $isExternal ? 'yes' : 'no'
        ));
    }

    $this->newLine();
    $this->info('Total photo rows: ' . $rows->count());
    $this->info('Missing on public disk: ' . $missingCount);
})->purpose('Audit users.photo paths against storage disks');