<?php

declare(strict_types=1);

namespace Kumwe\Record\Value\Tests\Case;

use InvalidArgumentException;
use Kumwe\Conversion\Decimal\ExactDecimal;
use Kumwe\Record\Value\ClientAssertedInstant;
use Kumwe\Record\Value\ProtectedRecordValue;
use Kumwe\Record\Value\RecordValueGuard;
use Kumwe\Record\Value\Tests\TestCase;

final class NormalizationBoundaryTest extends TestCase
{
    public function testExactNumbersNullAndCanonicalMapOrder(): void
    {
        $decimal = ExactDecimal::fromString('12345678901234567890.001', 30, 3);
        $this->assertSame(
            ['a' => null, 'b' => '12345678901234567890.001'],
            RecordValueGuard::canonical(['b' => $decimal, 'a' => null]),
            'Canonical exact value and explicit null.'
        );
        $this->assertSame(['z', 'a'], RecordValueGuard::canonical(['z', 'a']), 'List order is semantic.');
        $this->assertThrows(
            static fn () => RecordValueGuard::canonical(['n' => 1.5]),
            InvalidArgumentException::class,
            'Reject float.'
        );
        $this->assertThrows(
            static fn () => RecordValueGuard::canonical("\xff"),
            InvalidArgumentException::class,
            'Reject invalid UTF-8.'
        );
    }

    public function testCanonicalCallEnforcesWholeTreeBudget(): void
    {
        $tree = 'leaf';
        for ($i = 0; $i < 9; ++$i) {
            $tree = [$tree];
        }
        $this->assertThrows(
            static fn () => RecordValueGuard::canonical($tree),
            InvalidArgumentException::class,
            'Depth is bounded at public entry.'
        );
        $this->assertThrows(
            static fn () => RecordValueGuard::canonical(array_fill(
                0,
                4096,
                null
            )),
            InvalidArgumentException::class,
            'Total nodes include root.'
        );
        $valid = array_fill(0, 4095, null);
        $this->assertSame($valid, RecordValueGuard::canonical($valid), 'Boundary is inclusive.');
    }

    public function testProtectedStorageAdapterPreservesExactRepresentation(): void
    {
        $storage = ['version' => 1,
             'algorithm' => 'xchacha20poly1305',
             'key_id' => 'revision-key-v1',
             'nonce' => 'AQE=',
             'ciphertext' => 'f38='];
        $marker = new ProtectedRecordValue($storage);
        $this->assertSame($storage, RecordValueGuard::canonical($marker), 'Opaque envelope storage bytes preserved.');
        $this->assertThrows(
            static fn () => new ProtectedRecordValue(['payload' => new \stdClass()]),
            InvalidArgumentException::class,
            'No executable or opaque objects.'
        );
        $this->assertThrows(
            static fn () => new ProtectedRecordValue([]),
            InvalidArgumentException::class,
            'Empty envelope refused.'
        );
    }

    public function testProtectedStorageCannotBypassAggregateStorageBounds(): void
    {
        $marker = new ProtectedRecordValue(['payload' => array_fill(0, 3000, null)]);
        $this->assertThrows(
            static fn () => RecordValueGuard::canonical([$marker,
             $marker]),
            InvalidArgumentException::class,
            'Opaque wrappers share the outer node budget.'
        );
        $this->assertThrows(
            static fn () => new ProtectedRecordValue([1 => 'payload']),
            InvalidArgumentException::class,
            'Storage envelope requires string keys.'
        );
        $this->assertThrows(
            static fn () => new ProtectedRecordValue(['payload' => 1.5]),
            InvalidArgumentException::class,
            'Floats cannot cross protected storage.'
        );
    }

    public function testProtectedStorageDoesNotRetainCallerReferences(): void
    {
        $ciphertext = 'AQ==';
        $storage = ['payload' => ['ciphertext' => &$ciphertext]];
        $marker = new ProtectedRecordValue($storage);
        $ciphertext = 'changed';
        $this->assertSame(
            ['payload' => ['ciphertext' => 'AQ==']],
            $marker->toStorage(),
            'Immutable storage detaches caller-owned references.',
        );
    }

    public function testClientCaptureRejectsCalendarCoercionAndKeepsUtcPrecision(): void
    {
        $instant = ClientAssertedInstant::fromPortableString('2024-02-29T12:30:00.123456+02:00');
        $this->assertSame(
            '2024-02-29T10:30:00.123456+00:00',
            $instant->toPortableString(),
            'UTC serialization preserves microseconds.'
        );
        foreach (
            ['2023-02-29T12:00:00Z',
             '2024-01-01T24:00:00Z',
             '2024-01-01T00:00:00+99:99',
             '2100-01-01T00:00:00Z'] as $invalid
        ) {
            $this->assertThrows(
                static fn () => ClientAssertedInstant::fromPortableString($invalid),
                InvalidArgumentException::class,
                'Invalid calendar/time range refused.'
            );
        }
        $this->assertSame(true, $instant->toArray()['asserted_by_client'], 'Client claim remains explicit.');
    }
}
