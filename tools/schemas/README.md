# Authoritative governance schemas

The public API, capability and service-map snapshots come from kumwe/app at `24ecf956423c18933e824b43cea1bfb9127a79a9`, under
`docs/architecture/governance/schemas/`. These development-only files are excluded from consumer archives.
The complete schemas are executed by pinned Ajv2020; do not replace them with field-presence checks.

| Schema | SHA-256 |
| --- | --- |
| package-release-record.v1.schema.json | e888a1fab5d6673f61bafaf0038c5195dbeffae6c41c8fe668fc76a735b721b0 |
| package-capabilities.v1.schema.json | ea796c665d1f530385a2e44c2f218ae94645173d863bc30502219166f51d5c17 |
| package-public-api.v1.schema.json | e31a87785248174701fcee11095a0f676debe76370e17e99e84c127a034f7996 |
| package-service-map.v1.schema.json | 826df42be526cb761df2e2f0aed4b4d5fa5421164b7093752a243e893d42090f |

The clean release-record schema is maintained with Extension SDK. It preserves full
source, symbol, DI, consumer, test and artifact constraints while excluding obsolete
PR/phase/state metadata. Source checks reject legacy process fields and composed
Core completion claims. Existing published archives remain unchanged.
