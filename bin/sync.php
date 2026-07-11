<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use BOA\Programs\Storage;
use BOA\Programs\Synchronizer;
use Carbon\CarbonImmutable as Carbon;

$version = $argv[1] ?? 'v3';

$today = Carbon::today('Asia/Tokyo');
$todayY = $today->format('Y');
$todayYmd = $today->format('Ymd');

$yesterday = $today->subDay();
$yesterdayY = $yesterday->format('Y');
$yesterdayYmd = $yesterday->format('Ymd');

$payload = [
    'today' => ['programs' => []],
    'yesterday' => ['programs' => []],
];

if ($version === 'v2' || $version === 'v3') {
    $payload['today']['programs'] = Synchronizer::sync($today);
    $payload['yesterday']['programs'] = Synchronizer::sync($yesterday);
}

if ($payload['today']['programs'] !== []) {
    Storage::save("docs/{$version}/{$todayY}/{$todayYmd}.json", $payload);
    Storage::save("docs/{$version}/today.json", $payload);
}

if ($payload['yesterday']['programs'] !== []) {
    Storage::save("docs/{$version}/{$yesterdayY}/{$yesterdayYmd}.json", $payload);
    Storage::save("docs/{$version}/yesterday.json", $payload);
}
