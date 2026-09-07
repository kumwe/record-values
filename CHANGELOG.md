# Changelog

## 0.1.1 - 2026-09-07

- Normalize the public ClientAssertedInstant value to UTC at construction while preserving its microsecond instant and client-only provenance.
- Add package-owned regression tests and refresh extraction handoff, dependency and release documentation.
- Keep exact stable dependency requirements; grouped weekly update PRs re-run the package gate.

## 0.1.0 - 2026-09-07

### Added

- Portable bounded record values, exact numeric normalization and temporal semantics.
- NRM-2026-029: package extraction enabling the Version 2 migration. Roadmap impact: enables; no completion claim.

Normal publication verifies exact stable dependency tag, source and dist identity.
Independent attestations remain optional separate verification evidence.
