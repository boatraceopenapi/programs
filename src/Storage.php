<?php

declare(strict_types=1);

namespace BOA\Programs;

use RuntimeException;

/**
 * @author shimomo
 */
final class Storage
{
    /**
     * @param non-empty-string $path
     * @param array<array-key, mixed> $payload
     * @return void
     * @throws \RuntimeException
     */
    public static function save(string $path, array $payload): void
    {
        $json = json_encode($payload);
        if ($json === false) {
            throw new RuntimeException("Failed to encode data to JSON");
        }

        $directory = dirname($path);
        if (!is_dir($directory) && !mkdir($directory, 0755, true) && !is_dir($directory)) {
            throw new RuntimeException("Failed to create directory: {$directory}");
        }

        if (file_put_contents($path, $json) === false) {
            throw new RuntimeException("Failed to save data to {$path}");
        }
    }
}
