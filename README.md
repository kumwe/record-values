# record-values

Portable bounded record values, exact numeric normalization and temporal semantics.

Canonical namespace: `Kumwe\Record\Value`. Requires PHP 8.5, 64-bit. Version 0.1.0 is recorded for automatic publication after human rebase merge and the complete package gate. App adoption is a separate integration change.

Pure values and stateless normalization are constructed directly. No empty container provider is registered. Services with real collaborators receive explicit factories when introduced.

See [public API](docs/public-api.md), [architecture](docs/architecture.md), [integration](docs/integration.md) and [test ownership](docs/test-ownership.md).

For standalone verification, run `composer install` and `composer check`; see `docs/integration.md`. `composer clean-consumer` verifies the archive in a fresh no-dev classmap-authoritative consumer. License: Apache-2.0.

Maintenance release: Normalize the public ClientAssertedInstant value to UTC at construction while preserving its microsecond instant and client-only provenance.

Direct Kumwe dependencies use exact stable versions. Dependabot proposes grouped weekly Composer updates; review and merge only after the complete package gate passes. The downstream App consumes a verified exact release, never an unreviewed moving `latest` constraint.

Source quality checks require Node.js 20+ and `npm ci --prefix tools/schema-validator --ignore-scripts`. The pinned Ajv2020/YAML gate validates all three canonical manifests and the complete handoff against authoritative schema snapshots, with rejection regressions. These development tools are excluded from consumer archives.
