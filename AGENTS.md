# Website Starter — agent guide

Drupal site recipe (`drupal/website_starter`): Standard recipe + UI Suite stack + Display Builder + the
UI Suite UIkit theme, with a component-built page layout, content displays and default content.
Part of the Webship Workspace (`~/workspace/products`): DDEV only.

## Layout

- `recipe.yml`: recipes, modules and config actions.
- `config/`: config imported as is (Display Builder page layout, displays).
- `content/`: default content in the core default content format (`drush content:export`).
- `scripts/generate-content.php`: maintainer script (re)generating the default content on a dev site.

## Rules

- No Layout Builder and no Canvas: displays are built with Display Builder and UIkit components
  (`ui_suite_uikit:*`). Source trees follow the UI Patterns 2 format: `source_id` + `source`, components as
  `component_id` / `variant_id` / `props` / `slots.<slot>.sources`.
- Config existing after the Standard recipe (entity displays) is changed with config actions, not by files in
  `config/` (non-strict recipes keep existing config).

## Test site

`~/workspace/test/websitetest` mounts this repository at `recipes/website_starter` and the theme at
`web/themes/contrib/ui_suite_uikit`:

```shell
cd ~/workspace/test/websitetest
ddev drush site:install recipes/website_starter -y
```
