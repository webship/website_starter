/**
 * @file
 * Webship-js (Cucumber-js + Playwright) configuration for the Website Starter.
 *
 * Environment:
 * - LAUNCH_URL: a site installed from the recipe
 *   (default https://websitetest.ddev.site).
 */
module.exports = {
  default: {
    timeout: 60000,
    requireModule: ['tsx/cjs'],
    require: [
      'node_modules/webship-js/tests/step-definitions/**/*.js',
      'node_modules/@webship-js/drupal-core-steps/tests/step-definitions/**/*.js', // @webship-js/drupal-core-steps: login by handle, the testing users, named pages, messages, listings, the editor, the media library, access control, site structure.
      'tests/step-definitions/**/*.js',
    ],
    paths: ['tests/features/**/*.feature'],
    format: [
      '@cucumber/pretty-formatter',
      'json:tests/reports/cucumber_report.json',
    ],
    worldParameters: {
      launchUrl: process.env.LAUNCH_URL || 'https://websitetest.ddev.site',
      // Accounts the login by handle (@webship-js/drupal-core-steps) logs in as; `Given I add the
      // testing users` creates the ones that are missing, with their roles. Webmaster is the
      // site-install super-admin (drush site:install --account-name=webmaster --account-pass=...).
      users: {
        'Webmaster': { username: 'webmaster', email: 'webmaster@example.test', password: process.env.DRUPAL_ADMIN_PASSWORD || 'dD.123123ddd', isAdmin: true },
        'Content editor': { username: 'content_editor_user', email: 'content_editor_user@example.test', password: 'dD.123123ddd', roles: ['content_editor'] },
        'Authenticated user': { username: 'authenticated_user', email: 'authenticated_user@example.test', password: 'dD.123123ddd', roles: [] },
      },
      minWaitTime: {
        page: 1000,
        before_scenario: 0,
        after_scenario: 0,
        before_step: 0,
        after_step: 0,
      },
      selectors: {
        css: {},
        xpath: {},
        filesPath: './tests/selectors/',
        files: [],
        offset: 60,
        breakpoints: {
          xs: { width: 400, height: 800 },
          l: { width: 1200, height: 900, default: true },
          xxl: { width: 1920, height: 1080 },
        },
      },
      screenshot: {
        dir: './screenshots',
        purge: false,
        onFailed: true,
        onEveryStep: false,
        alwaysFullscreen: false,
        failedPrefix: 'failed_',
        filenamePattern: '{datetime}.{feature_file}.feature_{step_line}.{ext}',
        filenamePatternFailed: '{failed_prefix}{datetime}.{feature_file}.feature_{step_line}.{ext}',
        infoTypes: '',
      },
    },
  },
};
