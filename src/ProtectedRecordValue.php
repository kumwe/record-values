<?php

declare(strict_types=1);

namespace Kumwe\Record\Value;

/**
 * Opaque canonical protected-value storage supplied by the host cryptography adapter.
 *
 * This value performs no cryptography and makes no authenticity claim. The host
 * verifies/decrypts envelopes through Secret Envelope and supplies their canonical
 * storage representation. Keeping that representation opaque preserves record
 * checksum bytes without introducing an encryption implementation or dependency.
 */
final readonly class ProtectedRecordValue
{
    /** @var array<string, mixed> */
    private array $storage;

    /**
     * @param array<array-key, mixed> $storage Canonical envelope storage, never plaintext.
     * @throws \InvalidArgumentException When storage is empty, non-map or not bounded JSON data.
     */
    public function __construct(array $storage)
    {
        if ($storage === [] || array_is_list($storage)) {
            throw new \InvalidArgumentException('Protected record storage must be a non-empty map.');
        }
        RecordValueGuard::assertValue($storage);
        $this->assertOpaque($storage);
        $detached = [];
        foreach ($storage as $key => $value) {
            if (!is_string($key)) {
                throw new \InvalidArgumentException('Protected record storage requires string keys.');
            }
            $detached[$key] = self::detach($value);
        }
        $this->storage = $detached;
    }

    /** @return array<string, mixed> Exact storage order/bytes supplied by the host. */
    public function toStorage(): array
    {
        return $this->storage;
    }

    /** Copy admitted JSON data without retaining caller-owned PHP references. */
    private static function detach(mixed $value): mixed
    {
        if (!is_array($value)) {
            return $value;
        }
        $copy = [];
        foreach ($value as $key => $child) {
            $copy[$key] = self::detach($child);
        }
        return $copy;
    }

    /** @param array<array-key, mixed> $storage */
    private function assertOpaque(array $storage, int $depth = 0): void
    {
        if ($depth > 8) {
            throw new \InvalidArgumentException('Protected record storage exceeds its depth bound.');
        }
        foreach ($storage as $value) {
            if (is_array($value)) {
                $this->assertOpaque($value, $depth + 1);
            } elseif (!is_null($value) && !is_bool($value) && !is_int($value) && !is_string($value)) {
                throw new \InvalidArgumentException('Protected record storage accepts JSON values only.');
            }
        }
    }
}
