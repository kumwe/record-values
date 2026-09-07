# Public API

All values enforce the documented constructor invariants. Domain methods perform no I/O, own no transaction and make no authorization decisions. Immutable values are safe to share; host inputs and lookup ports must remain generation-stable for the duration of an operation. Exceptions and parameter detail appear below verbatim from the source contract.

## Kumwe\Record\Value\RecordValueGuard

/**
 * Gatekeeper for what may appear inside a business-record value, and how it is spelled for storage.
 *
 * Every field value that reaches a record, a revision, a query or a fingerprint passes through here.
 * `assertValue()` is the admission check: it accepts null, bool, int and string, the domain value
 * objects `ExactDecimal`, `MoneyValue`, `QuantityValue`, `ZonedDateTimeValue` and `ProtectedRecordValue`,
 * `DateTimeImmutable`, and arrays of those — and refuses PHP floats outright, so a decimal, money or
 * quantity field cannot lose digits on its way to a column. `canonical()` is the matching storage
 * spelling, which is the form that actually gets written, checksummed and compared. The two are used
 * together, as `RecordValueCodec` does, because admission bounds the structure and canonicalisation
 * makes it byte-stable.
 *
 * @since  2.0.0
 */

### assertValue

/**
     * Refuse a value the record layer has no safe storage spelling for.
     *
     * Arrays are walked to their leaves, bounded by $depth and $nodes so that a deeply nested or very
     * wide payload is rejected before anything tries to canonicalise or hash it. $nodes is taken by
     * reference and shared across the whole recursion, so the budget covers the value as a whole rather
     * than each branch separately; both counters default to the values a caller checking one value from
     * the outside would pass.
     *
     * @param   mixed  $value  Value to admit, at any depth within the structure.
     * @param   int    $depth  Nesting level of $value, 0 at the top; deeper than 8 is refused.
     * @param   int    $nodes  Running count of nodes visited so far; more than 4096 is refused.
     *
     * @return  void
     *
     * @throws  InvalidArgumentException  When the value is a float, is an object or resource outside the
     *          supported set, or breaches the depth or node budget.
     *
     * @since   2.0.0
     */

### canonical

/**
     * Reduce a value to the byte-stable form that is stored, checksummed and compared.
     *
     * Each domain value object becomes its storage spelling — a decimal its canonical literal; money,
     * quantities and zoned date-times their arrays; an encrypted envelope its storage array; a
     * `DateTimeImmutable` an ISO-8601 string with microseconds and offset — and string-keyed arrays are
     * sorted with `SORT_STRING` so key order never reaches a digest, while list order, which carries
     * meaning, is left alone. The complete tree, including protected storage, is admitted before normalization.
     * Depth and node budgets apply to the full storage representation.
     *
     * @param   mixed  $value  Value to reduce, typically one field value or a map of them by handle.
     *
     * @return  mixed  Null, bool, int, string, or arrays of those; no domain object survives the reduction.
     *
     * @throws  InvalidArgumentException  When a leaf is a float, or an object or resource the guard has no
     *          storage spelling for.
     *
     * @since   2.0.0
     */

## Kumwe\Record\Value\ZonedDateTimeValue

/**
 * A UTC instant paired with the IANA timezone the value was authored in.
 *
 * This is the whole value of a `core.zoned_datetime` field: `RecordValueCodec` splits it across the
 * `.instant` and `.timezone` physical columns and rebuilds it on read, because an offset alone loses
 * the rule that produced it — keeping the zone name means a stored time can still be rendered as its
 * author meant after that zone's offset rules change. The constructor is private, so every instance
 * has come through `fromStrings()` and already holds a portable UTC instant beside a canonical zone
 * name, which is what lets `toArray()` be stored, checksummed and compared as plain strings.
 *
 * @since  0.2.0
 */

### fromStrings

/**
     * Build the value from a canonical UTC instant and an IANA zone name.
     *
     * Nothing is repaired silently. The instant is accepted only in the exact form this type writes —
     * `Y-m-d\TH:i:s`, optional microseconds, then `Z` or `+00:00` — and is re-inspected after parsing
     * for a zero offset, a four-digit year, and a parse that raised no warning or error, so a value PHP
     * would quietly coerce is refused instead. The timezone must appear in
     * `DateTimeZone::listIdentifiers()`, which rules out the raw offsets and abbreviations
     * `DateTimeZone` would otherwise construct happily.
     *
     * @param   string  $instant   UTC timestamp in `Y-m-d\TH:i:s[.u]` form with a `Z` or `+00:00` suffix.
     * @param   string  $timezone  Canonical IANA zone name, such as `Africa/Johannesburg`.
     *
     * @return  self  Value holding the parsed instant in UTC beside the canonical zone name.
     *
     * @throws  InvalidArgumentException  When the instant is not in canonical UTC form, does not parse
     *          cleanly into a portable UTC time, or the timezone is not a canonical IANA identifier.
     *
     * @since   0.2.0
     */

### toArray

/**
     * Export the pair in the canonical shape used for storage, checksums and API output.
     *
     * @return  array{instant: string, timezone: string}  The instant as `Y-m-d\TH:i:s.u\Z`, always with
     *          six fractional digits, beside the IANA zone name.
     *
     * @since   0.2.0
     */

## Kumwe\Record\Value\ClientAssertedInstant

/**
 * The instant a client says the work happened, recorded beside the server's own and never in place of it.
 *
 * A terminal that captures a sale on Friday and submits it on Monday is asserting something the platform
 * cannot check: its own clock. Decision D14 requires that such a claim have a declared place to live, and
 * this is that place. The type exists so the assertion can be carried, read and audited without ever
 * being mistaken for the authoritative instant — `BusinessRecordService` keeps stamping every row from
 * its injected clock, and nothing here replaces that.
 *
 * **What this instant is never used for**, because a client's clock cannot be trusted with any of it:
 *
 * - **Ordering.** Events are ordered by allocated sequence, which is a server-side fact. A document
 *   captured earlier and submitted later is ordered where it arrived, and its capture instant explains
 *   the gap rather than reopening the sequence. Arrival order is not capture order and neither is
 *   negotiable by a caller.
 * - **Expiry.** An idempotency claim's replay and retention horizons run from the server's instant, so a
 *   terminal cannot lengthen its own replay window by asserting a later capture.
 * - **Period assignment.** Which accounting period a document falls in is decided from server-held
 *   declarations, so a client cannot post into a period by asserting a date inside it.
 * - **Numbering.** A document number is allocated by the receiving command from a server-side counter,
 *   so capture order can never reorder a statutory sequence.
 *
 * `ClientAssertedInstantBoundaryTest` proves each of those mechanically rather than leaving them as
 * intentions: it enumerates the paths that consume an instant for one of those four decisions and fails
 * the build if any of them can reach this type.
 *
 * **Late and out-of-order arrival is accepted, not tolerated as an edge case.** A command carrying a
 * capture instant days behind the server's is an ordinary command: it is validated, numbered, sequenced
 * and audited exactly as one captured a second ago, and the assertion is recorded so a reader can tell
 * the two apart afterwards.
 *
 * @since  2.0.0
 */

### __construct

/**
     * Capture one client-asserted instant, normalized to UTC at microsecond precision.
     *
     * @param   DateTimeImmutable  $capturedAt  Instant the client says the work happened, in any zone.
     *
     * @throws  InvalidArgumentException  When the instant falls outside the representable range, which
     *          means the value is a corrupt clock reading rather than a claim about when work happened.
     *
     * @since   2.0.0
     */

### fromPortableString

/**
     * Read a client-asserted instant from the text a caller submitted.
     *
     * @param   string  $value  RFC 3339 instant with an explicit offset.
     *
     * @return  self  The claim, normalized to UTC.
     *
     * @throws  InvalidArgumentException  When the text is not an RFC 3339 instant with an offset, or the
     *          instant it names is outside the recordable range.
     *
     * @since   2.0.0
     */

### toPortableString

/**
     * Spell the claim in the one canonical form every surface and the audit trail carry it in.
     *
     * @return  string  UTC instant at microsecond precision, such as `2026-08-14T09:30:00.000000+00:00`.
     *
     * @since   2.0.0
     */

### toArray

/**
     * Export the claim in a shape that says whose clock it came from.
     *
     * The `asserted_by_client` marker is unconditional and the instant sits under `captured_at` rather
     * than at the top level, so a reader of an audit entry or an event payload cannot mistake this for
     * the server's own instant, which is recorded separately and always wins.
     *
     * @return  array{asserted_by_client: true, captured_at: string}  The claim and its provenance.
     *
     * @since   2.0.0
     */

## Kumwe\Record\Value\ProtectedRecordValue

/**
 * Opaque canonical protected-value storage supplied by the host cryptography adapter.
 *
 * This value performs no cryptography and makes no authenticity claim. The host
 * verifies/decrypts envelopes through Secret Envelope and supplies their canonical
 * storage representation. Keeping that representation opaque preserves record
 * checksum bytes without introducing an encryption implementation or dependency.
 */

### __construct

/**
     * @param array<array-key, mixed> $storage Canonical envelope storage, never plaintext.
     * @throws \InvalidArgumentException When storage is empty, non-map or not bounded JSON data.
     */

### toStorage

/** @return array<string, mixed> Exact storage order/bytes supplied by the host. */

