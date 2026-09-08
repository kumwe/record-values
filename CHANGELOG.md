# Changelog

## 0.1.3

- Select published Conversion 0.1.4, which carries the v2 extraction handoff required for the
  coordinated downstream dependency train; preserve the existing 0.1.2 release.
- Align dependency evidence coordinates and successor manifest/handoff identities. No runtime
  or public signature changes; all behavior, boundary, conformance and archive gates remain required.

## 0.1.2

- Align exact dependency pins and release-readiness records with a coherent published Composer graph.
- Fail the complete package gate on missing, extra, duplicate or stale dependency evidence coordinates;
  cover the previous drift and non-exact pins with negative regression fixtures.
- Refresh release manifests and handoff digests; retain package-owned behavior, boundary, conformance
  and no-dev archive-consumer checks. Independent release verification remains separate.

## 0.1.1 - 2026-09-07

- Ship consumer-readable v2 manifests and YAML handoff with package-local governance drift checks and refreshed App consumer inventory.

- Normalize the public ClientAssertedInstant value to UTC at construction while preserving its microsecond instant and client-only provenance.
- Add package-owned regression tests and refresh extraction handoff, dependency and release documentation.
- Keep exact stable dependency requirements; grouped weekly update PRs re-run the package gate.

## 0.1.0 - 2026-09-07

### Added

- Portable bounded record values, exact numeric normalization and temporal semantics.
- NRM-2026-029: package extraction enabling the Version 2 migration. Roadmap impact: enables; no completion claim.

Normal publication verifies exact stable dependency tag, source and dist identity.
Independent attestations remain optional separate verification evidence.
