# Integration

Consume only an independently verified immutable release; exact pins are mandatory before 1.0. App supplies already authorized values and trusted definitions. Database adapters, scope authority, policy enforcement, signing secrets, persistence and delivery remain in App. See the [release record](release-record.md) for baseline mappings and consumer verification requirements.

## Source and archive verification


`ProtectedRecordValue` detaches PHP references and admits only bounded JSON storage. App maps its authenticated `EncryptedEnvelope::toStorage()` representation into this marker. App must retain cryptographic authenticity, associated-data, rotation and key-lifecycle tests; this marker grants no trust and performs no cryptography.

Run `composer install` and `composer check`. Source CI installs exact published Kumwe dependencies and builds an isolated no-dev classmap-authoritative archive consumer. The complete gate includes package-owned behavior, boundary and conformance tests, static analysis, API and ownership checks, release automation fixtures and clean-consumer verification.

Exact pre-1.0 dependency pins change through reviewed update PRs. A moving `latest` coordinate would make the verified dependency closure irreproducible.
