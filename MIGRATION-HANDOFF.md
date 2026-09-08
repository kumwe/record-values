---
schema: "kumwe-migration-handoff/v2"
artifact_kind: "framework_php"
migration_id: "KUMWE-MIG-2026-029"
change_set: "KUMWE-CS-2026-029"
state: "draft_pr_open"
source:
  app:
    repository: "https://github.com/kumwe/app"
    baseline_commit: "24ecf956423c18933e824b43cea1bfb9127a79a9"
    examined_paths:
      - "docs/architecture/governance/core-growth-baseline.json"
      - "src/BusinessRecord/Application/BusinessRecordMutationPublication.php"
      - "src/BusinessRecord/Application/BusinessRecordRelationshipCoordinator.php"
      - "src/BusinessRecord/Application/BusinessRecordRevisionView.php"
      - "src/BusinessRecord/Application/BusinessRecordService.php"
      - "src/BusinessRecord/Application/Command/WriteDocumentCommand.php"
      - "src/BusinessRecord/Application/PostingPeriodLock.php"
      - "src/BusinessRecord/Application/RecordExpressionValues.php"
      - "src/BusinessRecord/Application/RecordFingerprint.php"
      - "src/BusinessRecord/Application/RecordRequestGuard.php"
      - "src/BusinessRecord/Application/RecordRuleValidator.php"
      - "src/BusinessRecord/Application/RecordValueCodec.php"
      - "src/BusinessRecord/Domain/ClientAssertedInstant.php"
      - "src/BusinessRecord/Domain/RecordValueGuard.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordRevisionRepository.php"
      - "src/BusinessSurface/Application/BusinessMutationPlanService.php"
      - "src/BusinessSurface/Application/BusinessRecordProjector.php"
      - "src/BusinessSurface/Presentation/Field/CoreFieldPresenter.php"
      - "src/Demo/Infrastructure/DemoBusinessProfileExporter.php"
      - "tests/Architecture/ClientAssertedInstantBoundaryTest.php"
      - "tests/Architecture/ConvertedMoneySurfaceCoverageTest.php"
      - "tests/Architecture/MoneyConversionBoundaryTest.php"
      - "tests/Architecture/TruthfulQualityGateTest.php"
      - "tests/Architecture/UnitConversionBoundaryTest.php"
      - "tests/Integration/BusinessRecord/BusinessRecordRuntimeIntegrationTest.php"
      - "tests/Support/BusinessRuntimeBackupAcceptance.php"
      - "tests/Unit/BusinessRecord/Domain/ExactDecimalTest.php"
      - "tests/Unit/BusinessRecord/Domain/ExactValueCodecTest.php"
      - "tests/Unit/BusinessSurface/Presentation/ConvertedMoneyPresentationInvariantTest.php"
    old_namespace_roots:
      - "Kumwe\\App\\BusinessRecord\\"
      - "Kumwe\\App\\BusinessSchema\\"
      - "Kumwe\\App\\BusinessReporting\\"
    capability_index_sha256: null
  semantic_inputs:
    -
      owner: "kumwe/extension-sdk"
      version_or_commit: "e8ec23f155c5836c6bd083f154a8efb6e50aec66"
      manifest_or_corpus: "resources/extraction/v1.json"
      sha256: "5eff65a879d7781365038179e38b6f5b436303eab3a8319afce8d2b8fd059db9"
  examined_dependencies:
    - "kumwe/conversion 0.1.4; independent release attestation not asserted"
  active_related_pull_requests: []
target:
  repository: "https://github.com/kumwe/record-values"
  artifact_identity: "kumwe/record-values"
  canonical_namespace_or_abi: "Kumwe\\Record\\Value\\"
  branch: "fix/verified-conversion-dependency"
  pull_request: "https://github.com/kumwe/record-values/pull/6"
ownership:
  responsibility: "Portable bounded record values, exact numeric normalization and temporal semantics."
  non_responsibilities:
    - "authorization"
    - "trusted generation selection"
    - "persistence"
    - "SQL execution"
    - "transactions"
    - "delivery"
    - "native execution"
  allowed_dependency_ceiling:
    - "php"
    - "php-64bit"
    - "ext-json"
    - "kumwe/conversion"
    - "ext-mbstring"
  implementation_owner: "kumwe/record-values"
  next_consumer: "kumwe/app"
  public_manifests:
    -
      path: "resources/public-api/v1.json"
      sha256: "9a3becb0ad1751cce08be8a7f39b3b2ad0e57519bd293156cccbdcdf7ba788b1"
    -
      path: "resources/capabilities/v1.json"
      sha256: "9d69952dcc85e4a283eec5aaade79fd1eef185c2dbf51f228029033680119d22"
    -
      path: "resources/service-map/v1.json"
      sha256: "2bcdc2922b04a248efddf0ea5ed2ffc7c3e738975579efb7dfde6ca84d05f1bc"
    -
      path: "resources/test-ownership/v1.json"
      sha256: "843a739040638f4bcc14cc7932826ac1b23aa8eb0ba503d3a441ec77e6031703"
  intentionally_excluded:
    - "App repositories, policy gates and lifecycle orchestration"
    - "production PHP native executor fallback"
framework_php:
  composer_package: "kumwe/record-values"
  canonical_namespace: "Kumwe\\Record\\Value\\"
  public_api_manifest: "resources/public-api/v1.json"
  capability_manifest: "resources/capabilities/v1.json"
  service_map: "resources/service-map/v1.json"
  extracted_symbols:
    -
      old_fqcn: "Kumwe\\App\\BusinessRecord\\Domain\\RecordValueGuard"
      new_fqcn: "Kumwe\\Record\\Value\\RecordValueGuard"
      source_path: "src/BusinessRecord/Domain/RecordValueGuard.php"
      target_path: "src/RecordValueGuard.php"
      kind: "class"
      public_methods:
        - "assertValue"
        - "canonical"
      public_properties: []
      public_constants: []
      exceptions:
        - "InvalidArgumentException"
      serialization_contract: "See docs/public-api.md and package conformance corpus for exact serialization."
      compatibility: "Portable source closure; host authority stays with the consumer. See resources/extraction/v1.json for source ownership and extraction granularity."
    -
      old_fqcn: "Kumwe\\App\\BusinessRecord\\Domain\\ClientAssertedInstant"
      new_fqcn: "Kumwe\\Record\\Value\\ClientAssertedInstant"
      source_path: "src/BusinessRecord/Domain/ClientAssertedInstant.php"
      target_path: "src/ClientAssertedInstant.php"
      kind: "class"
      public_methods:
        - "__construct"
        - "fromPortableString"
        - "toPortableString"
        - "toArray"
      public_properties:
        - "capturedAt"
      public_constants:
        - "INSTANT_FORMAT"
      exceptions:
        - "InvalidArgumentException"
      serialization_contract: "See docs/public-api.md and package conformance corpus for exact serialization."
      compatibility: "Portable source closure; host authority stays with the consumer. See resources/extraction/v1.json for source ownership and extraction granularity."
    -
      old_fqcn: "Kumwe\\Extension\\Spi\\BusinessRecord\\Value\\ZonedDateTimeValue"
      new_fqcn: "Kumwe\\Record\\Value\\ZonedDateTimeValue"
      source_path: "src/Spi/BusinessRecord/Value/ZonedDateTimeValue.php"
      target_path: "src/ZonedDateTimeValue.php"
      kind: "class"
      public_methods:
        - "fromStrings"
        - "toArray"
      public_properties:
        - "instant"
        - "timezone"
      public_constants: []
      exceptions:
        - "InvalidArgumentException"
      serialization_contract: "See docs/public-api.md and package conformance corpus for exact serialization."
      compatibility: "Portable source closure; host authority stays with the consumer. See resources/extraction/v1.json for source ownership and extraction granularity."
    -
      old_fqcn: "Kumwe\\Record\\Value\\ProtectedRecordValue"
      new_fqcn: "Kumwe\\Record\\Value\\ProtectedRecordValue"
      source_path: "src/ProtectedRecordValue.php"
      target_path: "src/ProtectedRecordValue.php"
      kind: "class"
      public_methods:
        - "__construct"
        - "toStorage"
      public_properties: []
      public_constants: []
      exceptions:
        - "\\InvalidArgumentException"
      serialization_contract: "See docs/public-api.md and package conformance corpus for exact serialization."
      compatibility: "New package value utility; see resources/extraction/v1.json for source method provenance."
  consumers:
    app_code:
      - "src/BusinessRecord/Application/BusinessRecordMutationPublication.php"
      - "src/BusinessRecord/Application/BusinessRecordRelationshipCoordinator.php"
      - "src/BusinessRecord/Application/BusinessRecordRevisionView.php"
      - "src/BusinessRecord/Application/BusinessRecordService.php"
      - "src/BusinessRecord/Application/Command/WriteDocumentCommand.php"
      - "src/BusinessRecord/Application/PostingPeriodLock.php"
      - "src/BusinessRecord/Application/RecordExpressionValues.php"
      - "src/BusinessRecord/Application/RecordFingerprint.php"
      - "src/BusinessRecord/Application/RecordRequestGuard.php"
      - "src/BusinessRecord/Application/RecordRuleValidator.php"
      - "src/BusinessRecord/Application/RecordValueCodec.php"
      - "src/BusinessRecord/Domain/RecordValueGuard.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordRevisionRepository.php"
      - "src/BusinessSurface/Application/BusinessMutationPlanService.php"
      - "src/BusinessSurface/Application/BusinessRecordProjector.php"
      - "src/BusinessSurface/Presentation/Field/CoreFieldPresenter.php"
      - "src/Demo/Infrastructure/DemoBusinessProfileExporter.php"
    configuration_and_di:
      - "docs/architecture/governance/core-growth-baseline.json"
    reflection_and_string_references: []
    fixtures_and_examples:
      - "tests/Architecture/ClientAssertedInstantBoundaryTest.php"
      - "tests/Architecture/ConvertedMoneySurfaceCoverageTest.php"
      - "tests/Architecture/MoneyConversionBoundaryTest.php"
      - "tests/Architecture/TruthfulQualityGateTest.php"
      - "tests/Architecture/UnitConversionBoundaryTest.php"
      - "tests/Integration/BusinessRecord/BusinessRecordRuntimeIntegrationTest.php"
      - "tests/Support/BusinessRuntimeBackupAcceptance.php"
      - "tests/Unit/BusinessRecord/Domain/ExactDecimalTest.php"
      - "tests/Unit/BusinessRecord/Domain/ExactValueCodecTest.php"
      - "tests/Unit/BusinessSurface/Presentation/ConvertedMoneyPresentationInvariantTest.php"
    external:
      - "kumwe/extension-sdk coordinated successor"
  dependency_injection:
    mode: "direct"
    provider: null
    factories: []
    aliases: []
    service_lifetimes: []
    configuration_keys: []
    provider_absence_reason: "Values, contracts and stateless deterministic operations are constructed directly. Host ports are explicit inputs; no global context is captured."
native_cpp: null
php_extension: null
tests:
  moved_or_added:
    - "tests/Case/NormalizationBoundaryTest.php (testExactNumbersNullAndCanonicalMapOrder, testCanonicalCallEnforcesWholeTreeBudget, testProtectedStorageAdapterPreservesExactRepresentation, testProtectedStorageCannotBypassAggregateStorageBounds, testProtectedStorageDoesNotRetainCallerReferences, testClientCaptureRejectsCalendarCoercionAndKeepsUtcPrecision, testClientCapturePropertyMatchesCanonicalUtcContract); provenance: resources/test-ownership/v1.json"
    - "tests/Case/ZonedDateTimeValueTest.php (testCanonicalExportRoundTripsAtPortableAndFractionalBoundaries, testSilentCalendarRepairAndOffsetOnlyZonesAreRefused); provenance: resources/test-ownership/v1.json"
  remain_in_app_or_consumer:
    - "SQL/database matrix"
    - "policy-before-query"
    - "authorization and generation fences"
    - "cryptographic envelope authenticity and key lifecycle"
    - "transaction/concurrency and recovery"
    - "export/delivery/adapters"
  split_tests: []
  prohibited_duplicates:
    - "Do not retain moved implementation tests in App/SDK after the separate verified adoption."
  corpora: []
documentation:
  charter: "CHARTER.md"
  readme: "README.md"
  public_api: "docs/public-api.md"
  architecture: "docs/architecture.md"
  integration_or_consumer: "docs/integration.md"
  examples:
    - "examples/consumer.php"
  changelog_record: "CHANGELOG.md / 0.1.3"
release_expectations:
  version_policy: "SemVer maintenance release 0.1.3 after human merge. Direct Kumwe dependencies use coherent exact published stable versions. Independent final release verification precedes App adoption."
  expected_artifact_types:
    - "Composer source zip"
  required_checks:
    - "composer check"
    - "composer security:audit"
    - "composer clean-consumer"
    - "review dependency ceiling"
    - "immutable release and source/artifact manifests independently attested"
  required_registry_or_installer: "Composer"
  required_external_attestation: true
next_task:
  phase_name: "Independent release verification, followed by separate App adoption"
  permitted_only_when:
    - "Human merges package PR"
    - "Immutable upstream dependency releases and target release are independently verified"
    - "External RELEASE-ATTESTATION.yaml exists and matches all source/artifact identities"
  consumer_repository: "https://github.com/kumwe/app"
  dependency_or_native_change: "Exact-pin the reviewed immutable package release and remove the former implementation. Never use this development branch as a released dependency."
  namespace_or_api_replacements:
    - "{\"old_owner\":\"app\",\"source_path\":\"src/BusinessRecord/Domain/RecordValueGuard.php\",\"target_path\":\"src/RecordValueGuard.php\",\"extraction_kind\":\"whole_file\"}"
    - "{\"old_owner\":\"app\",\"source_path\":\"src/BusinessRecord/Domain/ClientAssertedInstant.php\",\"target_path\":\"src/ClientAssertedInstant.php\",\"extraction_kind\":\"whole_file\"}"
    - "{\"old_owner\":\"extension-sdk\",\"source_path\":\"src/Spi/BusinessRecord/Value/ZonedDateTimeValue.php\",\"target_path\":\"src/ZonedDateTimeValue.php\",\"extraction_kind\":\"whole_file\"}"
    - "{\"old_owner\":\"new-package-code\",\"source_path\":null,\"target_path\":\"src/ProtectedRecordValue.php\",\"extraction_kind\":\"new_symbol\"}"
  files_to_update:
    - "composer.json"
    - "composer.lock"
    - "container configuration"
    - "capability index"
    - "migration ledger"
    - "CHANGELOG.md"
  files_to_remove:
    - "src/BusinessRecord/Domain/RecordValueGuard.php"
    - "src/BusinessRecord/Domain/ClientAssertedInstant.php"
    - "src/Spi/BusinessRecord/Value/ZonedDateTimeValue.php"
  tests_to_remove:
    - "{\"owner\":\"extension-sdk\",\"baseline_commit\":\"e8ec23f155c5836c6bd083f154a8efb6e50aec66\",\"path\":\"tests/Case/ZonedDateTimeValueTest.php\",\"methods\":[\"testCanonicalExportRoundTripsAtPortableAndFractionalBoundaries\",\"testSilentCalendarRepairAndOffsetOnlyZonesAreRefused\"],\"retained_methods\":[],\"remove_whole_file\":true}"
  tests_to_retain_or_add:
    - "Host responsibility cases listed above"
    - "Native parity against committed semantic corpus where applicable"
  di_or_provisioning_changes: []
  capability_index_changes:
    - "Record actual release and package responsibility without declaring composed roadmap completion."
  changelog_and_evidence_changes:
    - "Record immutable artifact, attestation and remaining host acceptance gates."
  verification_commands:
    - "composer check"
    - "composer clean-consumer"
    - "App affected integration train and platform matrix"
concurrency:
  likely_conflict_files:
    - "App composer.json"
    - "App composer.lock"
    - "App capability and migration registries"
  related_migrations:
    - "KUMWE-MIG-2026-030"
    - "KUMWE-MIG-2026-031"
    - "KUMWE-MIG-2026-032"
    - "KUMWE-MIG-2026-033"
  ownership_conflicts: []
  integration_train: null
  resolution_rule: "semantic-preservation"
governance:
  roadmap_source_sha256: "a202155ef1a65f5ab293d4f8397ebf4ac430db7f1e877c776bbe7851e6fe18d8"
  roadmap_refs: []
  non_roadmap_refs:
    - "NRM-2026-029"
  completion_claim: false
decisions:
  - "Canonical namespace and approved value behavior retained."
  - "No host authority or persistence moves into the package."
  - "See CHARTER.md for explicit dependency amendments; no release approval is inferred."
blockers:
  - "The 0.1.3 dependency successor requires maintainer review and merge. Version 0.1.2 has already been published."
  - "Independent verification of the final maintenance release and its complete dependency closure remains a separate task before App adoption."
---

# Migration handoff

## Migration/implementation summary

The published 0.1.0 package owns the portable source listed in the machine inventory.
The published 0.1.1 maintenance release completes immutable input snapshots, current release
metadata and consumer-readable governance records. App adoption is a separate phase.

## Public API and responsibility

The canonical namespace, exported signatures and service lifetimes are recorded in
the three resources manifests. See CHARTER.md, docs/public-api.md and docs/architecture.md
for invariants and the boundary between package semantics and host authority.

## Capability reuse/semantic input review

The semantic inputs and exact dependency requirements above identify reused owners.
No development branch or moving latest version is a release dependency. Published
transitive exact pins constrain updates until the prerequisite maintenance release exists.

## Consumer inventory

The framework_php.consumers inventory records App code, configuration and external
consumers. Those paths remain read-only during Phase 1; the integration task must
repeat the inventory against its chosen App commit before deleting legacy classes.

## Test ownership

Library behavior and regression tests live under tests/ and are indexed in
resources/test-ownership/v1.json. The machine test inventory preserves the source
provenance and separates host acceptance work from portable library behavior.

## Next-task execution notes

Review and merge this maintenance candidate, publish and independently verify its
release, then use docs/integration.md with the machine execution inventory for App
adoption. Native parity and host integration cannot be inferred from package unit tests.

## Drift check

The source baseline and source paths remain explicit in this record. Manifest
digests are regenerated together with the public signatures and reviewed test inventory.
Repeat the source/consumer inventory and dependency solve before integration.

## Validation recipe and observed local results

Run composer check and composer clean-consumer from a clean checkout. The local
unit and static-analysis gates passed during the maintenance review; release automation
and the clean consumer must pass for the final reviewed commit before publication.
The App v2 governance parser was also used read-only to verify all three manifests
and this handoff against the actual consumer contract.


## Maintenance review 2026-09-07

The portable source closure and package-owned conformance corpus remain in this library.
New behavior and immutability regression tests are recorded in the test ownership manifest.
Completed extraction instructions now describe shipped behavior; host composition, database
acceptance and App deletion steps remain in the separate adoption handoff above.

Exact dependency pins remain intentional. Business Definition and Record Values maintenance
releases must be published and verified before their dependent libraries can advance together.
A moving latest constraint cannot resolve incompatible exact pre-1.0 transitive requirements.

Integration train description: Framework 4 Business Data





The consumer inventory was recomputed against App 24ecf956423c18933e824b43cea1bfb9127a79a9
by searching tracked PHP, JSON, YAML, XML, JavaScript and TypeScript for the historical
fully qualified symbols and their escaped string forms. Configuration and fixtures
are listed separately; the adoption review must also resolve dynamically composed names.

## Dependency readiness update — 0.1.2

The 0.1.1 release is published. This candidate uses `kumwe/conversion 0.1.4`.
The Composer install and no-dev archive consumer resolve the complete transitive graph; the readiness
regression gate prevents its direct dependency records from drifting again. Null attestation coordinates
remain an explicit absence of independent verification, not a completed adoption claim.

Maintainer merge, final release publication and independent artifact/dependency verification remain
required before downstream adoption. No App implementation or integration changes are included.

## Conversion dependency handoff — 0.1.3

Conversion 0.1.4 is published and carries the v2 package handoff missing from the prior selected
release. This successor updates the exact requirement and evidence coordinates without changing
Record Values runtime behavior. Version 0.1.2 remains an unchanged historical release. The full
package and clean no-dev archive consumer gate must pass on this candidate and again on its
rebased release commit; independent artifact and dependency verification remain separate.
