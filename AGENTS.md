# Website Starter — agent guide

Drupal site template recipe (`drupal/website_starter`, recipe `type: Site`): Webship 12.0.x content types
(Webpage, Web Blog, media), Canvas-free Drupal CMS recipes, Webship service recipes, Webform, the UI Suite
stack, Display Builder and the UI Suite UIkit theme, with a component-built page layout, content displays and
demo content. Part of the Webship Workspace (`~/workspace/products`): DDEV only.

## Layout

- `recipe.yml`: included recipes, modules, config imports and config actions (the Drupal core Recipe and
  Config Action APIs: `simpleConfigUpdate`, `setThirdPartySettings`, …) and `extra.drupal_cms_installer` for
  the site template metadata.
- `config/`: default config imported as is (Display Builder page layout, social media menu, Pathauto pattern).
- `content/`: default content in the core default content format (YAML per entity, files next to the file
  entities). It is plain data maintained like config: no PHP script ships with the recipe.
- `tests/`: webship-js features, run against a site installed from the recipe.

## Rules

- No Canvas and no Layout Builder, not even installed: displays are built with Display Builder and UIkit
  components (`ui_suite_uikit:*`). Source trees follow the UI Patterns 2 format. Core Standard and the Drupal
  CMS admin UI are not included as recipes (they install Navigation, and Navigation and Dashboard require
  Layout Builder): their settings are copied in `recipe.yml` without them.
- The UIkit showcase webpages use the Full HTML text format with the UIkit markup, and the UIkit demo images
  (MIT) and NASA public domain photos only: never placeholder or CC BY-NC images.
- Config existing before this recipe (entity displays, fields) is changed with config actions, not by files in
  `config/` (non-strict recipes keep existing config).
- Default content changes: edit the YAML in `content/`, or build the content on a development site and export
  it with `drush content:export <entity_type> --with-dependencies --dir=…/content`.

## Test site

`~/workspace/test/websitetest` mounts this repository at `recipes/website_starter`:

```shell
cd ~/workspace/test/websitetest
ddev drush sql:drop -y && ddev drush site:install ../recipes/website_starter -y
cd ~/workspace/products/website_starter && npm test
```
