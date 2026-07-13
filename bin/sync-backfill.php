<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use BOA\Programs\Storage;
use BOA\Programs\Synchronizer;
use Carbon\CarbonImmutable as Carbon;

$version = $argv[1] ?? 'v3';
$date = $argv[2] ?? 'today';

$date = Carbon::parse($date, 'Asia/Tokyo');
$dateY = $date->format('Y');
$dateYmd = $date->format('Ymd');

$programs = Synchronizer::sync($date);

if ($programs === []) {
    fwrite(STDOUT, "NO_DATA {$dateYmd}\n");
    exit(2);
}

Storage::save("docs/{$version}/{$dateY}/{$dateYmd}.json", ['programs' => $programs]);
echo "OK {$dateYmd}\n";
exit(0);
