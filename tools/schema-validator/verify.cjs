'use strict';

// Development-only Draft 2020-12 validation of complete authoritative package contracts.
const fs = require('node:fs');
const path = require('node:path');
const assert = require('node:assert/strict');
const Ajv2020 = require('ajv/dist/2020').default;
const YAML = require('yaml');
const root = path.resolve(__dirname, '../..');
if (Number(process.versions.node.split('.')[0]) < 20) {
  throw new Error('The schema gate requires Node.js 20 or newer.');
}
const ajv = new Ajv2020({ allErrors: true, strict: false });
const read = relative => fs.readFileSync(path.join(root, relative), 'utf8');
const parseRecord = text => {
  if (!text.startsWith('---\n')) throw new Error('Release record opening front-matter boundary is missing.');
  const boundary = text.indexOf('\n---\n', 4);
  if (boundary < 0) throw new Error('Release record closing front-matter boundary is missing.');
  // Parse complete YAML front matter, rejecting duplicate keys and malformed quoting.
  return YAML.parse(text.slice(4, boundary), { uniqueKeys: true });
};
const documents = new Map();
for (const kind of ['public-api', 'capabilities', 'service-map', 'release-record']) {
  const schemaPath = 'tools/schemas/' + (kind === 'release-record'
    ? 'package-release-record.v1.schema.json' : 'package-' + kind + '.v1.schema.json');
  const schema = JSON.parse(read(schemaPath));
  const validate = ajv.compile(schema);
  const value = kind === 'release-record' ? parseRecord(read('docs/release-record.md'))
    : JSON.parse(read('resources/' + kind + '/v1.json'));
  if (!validate(value)) throw new Error(kind + ': ' + ajv.errorsText(validate.errors, { separator: '\n' }));
  documents.set(kind, { value, validate });
}
const reject = (kind, mutate) => {
  const { value, validate } = documents.get(kind);
  const candidate = structuredClone(value);
  mutate(candidate);
  assert.equal(validate(candidate), false, kind + ': malformed fixture was accepted');
};
reject('capabilities', value => { value.native_requirements = []; });
reject('capabilities', value => { delete value.responsibility; });
reject('capabilities', value => { value.capabilities[0].symbols = 'not-an-array'; });
reject('public-api', value => { delete value.symbols[Object.keys(value.symbols)[0]].kind; });
reject('public-api', value => { value.release = 'dev-main'; });
reject('service-map', value => { value.factories = {}; });
reject('service-map', value => { value.undeclared_field = true; });
reject('release-record', value => { delete value.target; });
reject('release-record', value => { value.source.app.baseline_commit = 'not-a-commit'; });
reject('release-record', value => { value.artifact_kind = 'unrecognized'; });
reject('release-record', value => { value.state = 'draft_pr_open'; });
reject('release-record', value => { value.governance.completion_claim = true; });
reject('release-record', value => { delete value.consumer_contract; });
assert.throws(() => parseRecord('---\n{"blockers": ["unterminated]}\n---\n'));
assert.throws(() => parseRecord('---\n{}\n'), /closing front-matter boundary/);
console.log('All 3 canonical manifests and full v1 release record satisfy authoritative Draft 2020-12 schemas.');
console.log('Schema gate passed 15 malformed, missing-field, nullability and front-matter refusal fixtures.');
