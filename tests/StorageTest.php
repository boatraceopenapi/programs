<?php

declare(strict_types=1);

namespace BOA\Programs\Tests;

use BOA\Programs\Storage;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @author shimomo
 */
final class StorageTest extends TestCase
{
    /**
     * @var non-empty-string
     */
    private string $tempDir;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->tempDir = sys_get_temp_dir() . '/storage_test_' . bin2hex(random_bytes(8));

        if (!mkdir($this->tempDir, 0755, true) && !is_dir($this->tempDir)) {
            $this->fail('Failed to create temp dir: ' . $this->tempDir);
        }
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        if (is_dir($this->tempDir)) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($this->tempDir, \FilesystemIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::CHILD_FIRST
            );

            foreach ($files as $file) {
                $file->isDir() ? rmdir($file->getRealPath()) : unlink($file->getRealPath());
            }

            rmdir($this->tempDir);
        }
    }

    /**
     * @return void
     */
    #[Test]
    public function testSave(): void
    {
        $path = $this->tempDir . '/program.json';
        $payload = [
            'program'=> [
                'date' => '2026-05-31',
                'stadium_number' => 6,
                'race_number' => 12,
            ],
        ];

        Storage::save($path, $payload);

        $this->assertFileExists($path);
        $savedPayload = json_decode(file_get_contents($path), true);
        $this->assertArrayHasKey('program', $savedPayload);
        $this->assertSame($payload, $savedPayload);
    }

    /**
     * @return void
     */
    #[Test]
    public function testSaveCreatesDirectoryWhenNotExists(): void
    {
        $path = $this->tempDir . '/nested/dir/program.json';
        $payload = ['program' => ['date' => '2026-05-31']];

        $this->assertDirectoryDoesNotExist(dirname($path));

        Storage::save($path, $payload);

        $this->assertDirectoryExists(dirname($path));
        $this->assertFileExists($path);
        $this->assertSame($payload, json_decode(file_get_contents($path), true));
    }

    /**
     * @return void
     */
    #[Test]
    public function testSaveOverwritesExistingFile(): void
    {
        $path = $this->tempDir . '/program.json';

        Storage::save($path, ['program' => ['race_number' => 1]]);
        Storage::save($path, ['program' => ['race_number' => 2]]);

        $savedPayload = json_decode(file_get_contents($path), true);
        $this->assertSame(2, $savedPayload['program']['race_number']);
    }

    /**
     * @return void
     */
    #[Test]
    public function testSaveThrowsWhenPayloadCannotBeEncoded(): void
    {
        // Invalid UTF-8 byte sequence makes json_encode() fail.
        $payload = ['invalid' => "\xB1\x31"];

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Failed to encode data to JSON');

        Storage::save($this->tempDir . '/invalid.json', $payload);
    }
}
