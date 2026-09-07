# Migration handoff

This candidate contains runtime implementation and package-owned tests. Publication and App adoption remain separate, attested tasks.

```yaml
{
  "schema": "kumwe-migration-handoff/v2",
  "artifact_kind": "framework_php",
  "migration_id": "KUMWE-MIG-2026-029",
  "change_set": "KUMWE-CS-2026-029",
  "state": "draft_pr_open",
  "source": {
    "app": {
      "repository": "https://github.com/kumwe/app",
      "baseline_commit": "24ecf956423c18933e824b43cea1bfb9127a79a9",
      "examined_paths": [
        "src/BusinessRecord/Domain/RecordValueGuard.php",
        "src/BusinessRecord/Domain/ClientAssertedInstant.php",
        "src/Spi/BusinessRecord/Value/ZonedDateTimeValue.php"
      ],
      "old_namespace_roots": [
        "Kumwe\\App\\BusinessRecord",
        "Kumwe\\App\\BusinessSchema",
        "Kumwe\\App\\BusinessReporting"
      ],
      "capability_index_sha256": null
    },
    "semantic_inputs": [
      {
        "owner": "kumwe/extension-sdk",
        "version_or_commit": "e8ec23f155c5836c6bd083f154a8efb6e50aec66",
        "manifest_or_corpus": "resources/extraction/v1.json",
        "sha256": "39f444e144b0a2b39cf82e7d0e4918ed5cb99cd97950f629fb25c0f995e11991"
      }
    ],
    "examined_dependencies": [
      {
        "package": "kumwe/conversion",
        "constraint": "0.1.0",
        "independently_verified": false,
        "attestation": null
      }
    ],
    "active_related_pull_requests": [
      "https://github.com/kumwe/business-schema/pull/1",
      "https://github.com/kumwe/record-query/pull/1",
      "https://github.com/kumwe/record-model/pull/1",
      "https://github.com/kumwe/reporting/pull/1"
    ]
  },
  "target": {
    "repository": "https://github.com/kumwe/record-values",
    "artifact_identity": "kumwe/record-values",
    "canonical_namespace_or_abi": "Kumwe\\Record\\Value\\",
    "branch": "agent/extraction-v2-business-data",
    "pull_request": "https://github.com/kumwe/record-values/pull/1"
  },
  "ownership": {
    "responsibility": "Portable bounded record values, exact numeric normalization and temporal semantics.",
    "non_responsibilities": [
      "authorization",
      "trusted generation selection",
      "persistence",
      "SQL execution",
      "transactions",
      "delivery",
      "native execution"
    ],
    "allowed_dependency_ceiling": [
      "php",
      "php-64bit",
      "ext-json",
      "kumwe/conversion",
      "ext-mbstring"
    ],
    "implementation_owner": "kumwe/record-values",
    "next_consumer": "kumwe/app",
    "public_manifests": [
      {
        "path": "resources/public-api/v1.json",
        "sha256": "fe829eac2e74738af8471d25c71cdc9f328fb8b19dbee94037a113de2878ad91"
      },
      {
        "path": "resources/capabilities/v1.json",
        "sha256": "88b30808fbca171c053cc3501b92c89b17834d619899eed82c9eb35c157c41ca"
      },
      {
        "path": "resources/service-map/v1.json",
        "sha256": "60af255c07f53100e75b81e199ec831bfeeec0456f14f59656211ef706fea0b8"
      },
      {
        "path": "resources/test-ownership/v1.json",
        "sha256": "701b06050f1cbb1c512265eb4c3f692b560184f7715968478e16545f6b446d79"
      }
    ],
    "intentionally_excluded": [
      "App repositories, policy gates and lifecycle orchestration",
      "production PHP native executor fallback"
    ]
  },
  "framework_php": {
    "composer_package": "kumwe/record-values",
    "canonical_namespace": "Kumwe\\Record\\Value\\",
    "public_api_manifest": "resources/public-api/v1.json",
    "capability_manifest": "resources/capabilities/v1.json",
    "service_map": "resources/service-map/v1.json",
    "extracted_symbols": [
      {
        "old_owner": "app",
        "source_path": "src/BusinessRecord/Domain/RecordValueGuard.php",
        "target_path": "src/RecordValueGuard.php"
      },
      {
        "old_owner": "app",
        "source_path": "src/BusinessRecord/Domain/ClientAssertedInstant.php",
        "target_path": "src/ClientAssertedInstant.php"
      },
      {
        "old_owner": "extension-sdk",
        "source_path": "src/Spi/BusinessRecord/Value/ZonedDateTimeValue.php",
        "target_path": "src/ZonedDateTimeValue.php"
      }
    ],
    "consumers": {
      "app_code": [
        "src/BusinessRecord/Domain/RecordValueGuard.php",
        "src/BusinessRecord/Domain/ClientAssertedInstant.php",
        "src/Spi/BusinessRecord/Value/ZonedDateTimeValue.php"
      ],
      "configuration_and_di": [],
      "reflection_and_string_references": [
        "Recompute using source/import closure at adoption head."
      ],
      "fixtures_and_examples": [],
      "external": [
        "kumwe/extension-sdk coordinated successor"
      ]
    },
    "dependency_injection": {
      "mode": "direct",
      "provider": null,
      "factories": [],
      "aliases": [],
      "service_lifetimes": [],
      "configuration_keys": [],
      "provider_absence_reason": "Values, contracts and stateless deterministic operations are constructed directly. Host ports are explicit inputs; no global context is captured."
    }
  },
  "native_cpp": null,
  "php_extension": null,
  "tests": {
    "moved_or_added": [
      {
        "path": "tests/Case/NormalizationBoundaryTest.php",
        "methods": [
          "testExactNumbersNullAndCanonicalMapOrder",
          "testCanonicalCallEnforcesWholeTreeBudget",
          "testProtectedStorageAdapterPreservesExactRepresentation",
          "testProtectedStorageCannotBypassAggregateStorageBounds",
          "testProtectedStorageDoesNotRetainCallerReferences",
          "testClientCaptureRejectsCalendarCoercionAndKeepsUtcPrecision"
        ],
        "implementation_owner": "kumwe/record-values"
      },
      {
        "path": "tests/Case/ZonedDateTimeValueTest.php",
        "methods": [
          "testCanonicalExportRoundTripsAtPortableAndFractionalBoundaries",
          "testSilentCalendarRepairAndOffsetOnlyZonesAreRefused"
        ],
        "implementation_owner": "kumwe/record-values"
      }
    ],
    "remain_in_app_or_consumer": [
      "SQL/database matrix",
      "policy-before-query",
      "authorization and generation fences",
      "cryptographic envelope authenticity and key lifecycle",
      "transaction/concurrency and recovery",
      "export/delivery/adapters"
    ],
    "split_tests": [],
    "prohibited_duplicates": [
      "Do not retain moved implementation tests in App/SDK after the separate verified adoption."
    ],
    "corpora": []
  },
  "documentation": {
    "charter": "CHARTER.md",
    "readme": "README.md",
    "public_api": "docs/public-api.md",
    "architecture": "docs/architecture.md",
    "integration_or_consumer": "docs/integration.md",
    "examples": [
      "examples/consumer.php"
    ],
    "changelog_record": "CHANGELOG.md / Unreleased"
  },
  "release_expectations": {
    "version_policy": "SemVer; determine release version after review. Replace development dependency constraints with exact independently verified pre-1.0 releases.",
    "expected_artifact_types": [
      "Composer source zip"
    ],
    "required_checks": [
      "composer check",
      "composer security:audit",
      "composer clean-consumer",
      "review dependency ceiling",
      "immutable release and source/artifact manifests independently attested"
    ],
    "required_registry_or_installer": "Composer",
    "required_external_attestation": true
  },
  "next_task": {
    "phase_name": "Independent release verification, followed by separate App adoption",
    "permitted_only_when": [
      "Human merges package PR",
      "Immutable upstream dependency releases and target release are independently verified",
      "External RELEASE-ATTESTATION.yaml exists and matches all source/artifact identities"
    ],
    "consumer_repository": "https://github.com/kumwe/app",
    "dependency_or_native_change": "Exact-pin the reviewed immutable package release and remove the former implementation. Never use this development branch as a released dependency.",
    "namespace_or_api_replacements": [
      {
        "old_owner": "app",
        "source_path": "src/BusinessRecord/Domain/RecordValueGuard.php",
        "target_path": "src/RecordValueGuard.php"
      },
      {
        "old_owner": "app",
        "source_path": "src/BusinessRecord/Domain/ClientAssertedInstant.php",
        "target_path": "src/ClientAssertedInstant.php"
      },
      {
        "old_owner": "extension-sdk",
        "source_path": "src/Spi/BusinessRecord/Value/ZonedDateTimeValue.php",
        "target_path": "src/ZonedDateTimeValue.php"
      }
    ],
    "files_to_update": [
      "composer.json",
      "composer.lock",
      "container configuration",
      "capability index",
      "migration ledger",
      "CHANGELOG.md"
    ],
    "files_to_remove": [
      "src/BusinessRecord/Domain/RecordValueGuard.php",
      "src/BusinessRecord/Domain/ClientAssertedInstant.php",
      "src/Spi/BusinessRecord/Value/ZonedDateTimeValue.php"
    ],
    "tests_to_remove": [
      "tests/Case/NormalizationBoundaryTest.php",
      "tests/Case/ZonedDateTimeValueTest.php"
    ],
    "tests_to_retain_or_add": [
      "Host responsibility cases listed above",
      "Native parity against committed semantic corpus where applicable"
    ],
    "di_or_provisioning_changes": [],
    "capability_index_changes": [
      "Record actual release and package responsibility without declaring composed roadmap completion."
    ],
    "changelog_and_evidence_changes": [
      "Record immutable artifact, attestation and remaining host acceptance gates."
    ],
    "verification_commands": [
      "composer check",
      "composer clean-consumer",
      "App affected integration train and platform matrix"
    ]
  },
  "concurrency": {
    "likely_conflict_files": [
      "App composer.json",
      "App composer.lock",
      "App capability and migration registries"
    ],
    "related_migrations": [
      "KUMWE-MIG-2026-030",
      "KUMWE-MIG-2026-031",
      "KUMWE-MIG-2026-032",
      "KUMWE-MIG-2026-033"
    ],
    "ownership_conflicts": [],
    "integration_train": "Framework 4 Business Data",
    "resolution_rule": "semantic-preservation"
  },
  "governance": {
    "roadmap_source_sha256": "a202155ef1a65f5ab293d4f8397ebf4ac430db7f1e877c776bbe7851e6fe18d8",
    "roadmap_refs": [],
    "non_roadmap_refs": [
      "NRM-2026-029"
    ],
    "completion_claim": false
  },
  "decisions": [
    "Canonical namespace and approved value behavior retained.",
    "No host authority or persistence moves into the package.",
    "See CHARTER.md for explicit dependency amendments; no release approval is inferred."
  ],
  "blockers": [
    "Immutable upstream releases and external attestations are not available for the entire dependency closure. No publication or App adoption is authorized by this candidate.",
    "Package candidate source checks do not substitute for clean immutable release verification."
  ]
}
```
