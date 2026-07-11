<?php

declare(strict_types=1);

namespace BOA\Programs;

use BVP\Scraper\Scraper;
use Carbon\CarbonImmutable as Carbon;
use DateTimeInterface;

/**
 * @author shimomo
 */
final class Synchronizer
{
    /**
     * @param \DateTimeInterface|string $date
     * @return array<array-key, mixed>
     */
    public static function sync(DateTimeInterface|string $date = 'today'): array
    {
        $date = Carbon::parse($date, 'Asia/Tokyo');

        /** @var array<array-key, array<array-key, array<array-key, array{boats: array<mixed>}>>> $programs */
        $programs = Scraper::scrapePrograms($date);

        return self::normalize($programs);
    }

    /**
     * @param array<array-key, array<array-key, array<array-key, array{boats: array<mixed>}>>> $programs
     * @return array<array-key, mixed>
     */
    private static function normalize(array $programs): array
    {
        $newPrograms = [];

        foreach (array_values($programs) as $data) {
            foreach (array_values($data) as $program) {
                $program['boats'] = isset($program['boats'])
                    ? array_values($program['boats'])
                    : [];

                $newPrograms[] = $program;
            }
        }

        return $newPrograms;
    }
}
