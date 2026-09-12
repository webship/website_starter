/**
 * @file
 * Custom webship-js step definitions for the Website Starter.
 */

const assert = require('node:assert');
const { Then } = require('@cucumber/cucumber');

/**
 * Example: Then the computed style "background-color" of "footer" should be "rgb(34, 34, 34)"
 */
Then(/^the computed style "([^"]*)" of "([^"]*)" should be "([^"]*)"$/, async function (property, selector, expected) {
  const locator = this.page.locator(selector).first();
  await locator.waitFor({ state: 'attached', timeout: 15000 });
  const actual = await locator.evaluate((element, name) => getComputedStyle(element).getPropertyValue(name), property);
  assert.strictEqual(actual.trim(), expected, `Computed "${property}" of "${selector}" is "${actual}".`);
});

/**
 * Example: Then the page should not contain escaped markup
 */
Then(/^the page should not contain escaped markup$/, async function () {
  const html = await this.page.content();
  const escaped = html.match(/&lt;\/?(p|span|div|a|time|strong|em)\b/g) || [];
  assert.deepStrictEqual(escaped, [], 'Escaped HTML found in the page.');
});

/**
 * Example: Then the response of "/admin/modules" should not list the "canvas" module as enabled
 */
Then(/^the Drupal page "([^"]*)" should (not )?contain "([^"]*)"$/, async function (path, not, text) {
  const response = await this.page.request.get(`${this.launchUrl}${path}`);
  const body = await response.text();
  assert.strictEqual(body.includes(text), !not, `"${text}" ${not ? 'found' : 'not found'} in ${path}.`);
});
