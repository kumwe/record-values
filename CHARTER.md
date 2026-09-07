# record-values

Portable bounded record values, exact numeric normalization and temporal semantics.

The package owns value invariants, canonical serialization and its behavior/boundary/conformance tests. The host owns authorization, trusted generation resolution, persistence, SQL, transactions, lifecycle, delivery and operational recovery. Native arithmetic belongs exclusively to Engine; this package contains no native fallback.
