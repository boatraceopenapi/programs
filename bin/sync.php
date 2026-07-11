<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use BOA\Programs\Storage;
use BOA\Programs\Synchronizer;
use Carbon\CarbonImmutable as Carbon;

$version = $argv[1] ?? 'v3';

$date = Carbon::today('Asia/Tokyo');

$dateY = $date->format('Y');
$dateYmd = $date->format('Ymd');

$payload = ['programs' => []];

if ($version === 'v2' || $version === 'v3') {
    $payload['programs'] = Synchronizer::sync($date);
}

if ($payload['programs'] === []) {
    exit;
}

Storage::save("docs/{$version}/{$dateY}/{$dateYmd}.json", $payload);
Storage::save("docs/{$version}/today.json", $payload);
