# Kumwe Record Values

[![Packagist version][version-badge]][package]
[![CI][ci-badge]][ci]
[![PHP requirement][php-badge]](composer.json)
[![License][license-badge]](LICENSE)

Bounded portable record values, exact numeric normalization and temporal semantics
under `Kumwe\Record\Value`.

## Installation

Requires 64-bit PHP 8.5 with JSON and mbstring. Pin an exact pre-1.0 release:

```sh
composer require kumwe/record-values:0.1.4
```

Composer declares the exact Conversion dependency. The version badge links published
packages; CI reports default-branch package checks. Core integration and independent
release verification are separate consumer responsibilities.

## Usage and Core contract

```php
require 'vendor/autoload.php';

$instant = \Kumwe\Record\Value\ClientAssertedInstant::fromPortableString('2024-02-29T10:00:00Z');
echo $instant->toPortableString(); // 2024-02-29T10:00:00.000000+00:00
```

Values and stateless normalization use direct construction. A client instant is a
UTC-normalized claim with microsecond precision; it never replaces server ordering,
expiry, accounting-period or numbering authority. `ProtectedRecordValue` admits
bounded detached JSON storage; Core retains authenticity, associated-data validation,
key lifecycle and rotation. The marker performs no cryptography or trust validation.

See [public API](docs/public-api.md), [architecture](docs/architecture.md),
[integration](docs/integration.md), [test ownership](docs/test-ownership.md),
[release record](docs/release-record.md) and the [standalone consumer](examples/consumer.php).

## Development

Requires Node.js 20+ for development schema validation:

```sh
npm ci --prefix tools/schema-validator --ignore-scripts
composer install
composer check
```

The pinned Ajv2020/YAML gate validates complete canonical manifests and release
records with rejection regressions. PHP checks cover behavior/conformance,
architecture, static analysis, manifests/governance, audit, dependency identities,
release automation and a no-dev classmap-authoritative archive consumer. CI runs
PHP 8.5 on Linux. Development tools are excluded from consumer archives.

Published tags remain fixed. See [releasing](docs/releasing.md) and [changelog](CHANGELOG.md).
Licensed under [Apache-2.0](LICENSE).

[version-badge]: https://img.shields.io/packagist/v/kumwe/record-values
[package]: https://packagist.org/packages/kumwe/record-values
[ci-badge]: https://img.shields.io/github/actions/workflow/status/kumwe/record-values/ci.yml?branch=main
[ci]: https://github.com/kumwe/record-values/actions/workflows/ci.yml
[php-badge]: https://img.shields.io/packagist/php-v/kumwe/record-values
[license-badge]: https://img.shields.io/packagist/l/kumwe/record-values
