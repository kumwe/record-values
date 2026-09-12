---
schema: "kumwe-package-release-record/v1"
artifact_kind: "framework_php"
migration_id: "KUMWE-MIG-2026-029"
change_set: "KUMWE-CS-2026-029"
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
    - "kumwe/conversion 0.1.5; independent release attestation not asserted"
target:
  repository: "https://github.com/kumwe/record-values"
  artifact_identity: "kumwe/record-values"
  canonical_namespace_or_abi: "Kumwe\\Record\\Value\\"
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
      sha256: "ca6e82ea1697041424ce2644b5fa0566c805d60da2f8d36ada2c19b16756b8b3"
    -
      path: "resources/capabilities/v1.json"
      sha256: "fa79ef590b02bae4f958bbbd8544e9a1f7a271cde45d2f2bac761e6a01b4308c"
    -
      path: "resources/service-map/v1.json"
      sha256: "b266081c33d866630f97b49b5e164eb090f0c54811a426031f9a4456f3fed111"
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
    - "tools/schema-validator/verify.cjs: complete canonical manifest and release-record schemas with 15 rejection fixtures"
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
  changelog_record: "CHANGELOG.md / 0.1.4"
release_expectations:
  version_policy: "SemVer maintenance release 0.1.4 after human merge. Direct Kumwe dependencies use coherent exact published stable versions. Independent final release verification precedes App adoption."
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
consumer_contract:
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
governance:
  completion_claim: false
decisions:
  - "Canonical namespace and approved value behavior retained."
  - "No host authority or persistence moves into the package."
  - "See CHARTER.md for explicit dependency amendments; no release approval is inferred."
blockers:
  - "Independent verification of the final maintenance release and its complete dependency closure remains a separate task before App adoption."
---

# Record Values release record

This record binds public manifests, baseline source ownership, consumer mappings,
DI requirements and test responsibilities. Baseline paths are compatibility evidence,
not the live status of another repository.

## Package contract

The package owns bounded portable record values, exact numeric normalization and
temporal semantics. Core supplies authorized inputs and owns storage, policy,
cryptographic trust, authoritative clocks, transactions and delivery.

## Public API and responsibility

See [public API](public-api.md), [architecture](architecture.md) and canonical API,
capability and service-map manifests. Values and stateless normalization use direct
construction. No empty provider or implicit authority service is registered.

## Dependencies and semantic inputs

Conversion owns shared numeric normalization; Composer declares its exact release.
Preserve the source ownership manifest, canonical value formats and conformance
corpus when evolving behavior. Exact published pins do not replace independent
artifact and dependency verification.

## Consumer contract

Core maps authenticated encrypted storage into ProtectedRecordValue only after
validating authenticity and associated data. The marker detaches references and
admits bounded JSON; it performs no cryptography and grants no trust. ClientAssertedInstant
normalizes the client's claim to UTC while preserving microseconds; it never supplies
server ordering, expiry, accounting-period or numbering authority.

## Test ownership

Package behavior, boundary and conformance tests are indexed in the
[test ownership contract](test-ownership.md) and resource manifest. Core retains
cryptographic authenticity, associated-data, rotation, key lifecycle, clock authority,
authorization and persistence integration coverage.

## Consumer verification

Independently verify exact releases, dependency source identities, archive and manifest
digests; then run the affected Core integration tests. Scan current imports, typed
signatures, configuration, escaped strings and fixtures before replacing duplicates.

## Compatibility and drift

Public value grammar, normalization, canonical bytes and trust provenance are
compatibility contracts. Reconcile source and consumer maps with current Core,
including dynamically composed names. Published release evidence remains fixed.

## Validation

Install the pinned Node schema toolchain and run `composer check`. The complete
Draft 2020-12 schema gate and rejection fixtures, PHP behavior/static checks,
governance, dependency evidence, audit, release tests and no-dev authoritative
archive consumer must pass for the exact tested source.
