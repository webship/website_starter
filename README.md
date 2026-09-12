# Website Starter

A Drupal site recipe to start a website with [Display Builder](https://www.drupal.org/project/display_builder)
and the [UI Suite UIkit](https://www.drupal.org/project/ui_suite_uikit) design system — no Layout Builder,
no Canvas: every page and every content display is built with UIkit components.

## What you get

- **The Standard recipe** of Drupal core: Article and Basic page content types, tags, text formats, roles,
  the Claro administration theme and the Navigation module.
- **The UI Suite stack**: UI Patterns 2 (library, blocks, layouts, field formatters, views), UI Styles,
  UI Icons, UI Skins, and Display Builder with its page layout, entity view and views integrations.
- **UI Suite UIkit** as the front-end theme.
- **A default page layout** built in Display Builder with UIkit components: sticky Navbar (logo, main menu,
  account menu, toggle), Offcanvas menu for small screens, content Section and footer Section.
- **Content displays** built in Display Builder: articles as UIkit Articles, teasers as UIkit Cards.
- **Default content**: pages (About, Services, Contact), a dozen articles with images spread over several
  pages of the front page listing, and the main and footer menu links.

## Requirements

- Drupal 11.4 or 12.
- Composer, with the dependencies declared in `composer.json`.

## Installation

Install a new site from the recipe:

```shell
composer require drupal/website_starter
drush site:install recipes/website_starter
```

Or start a whole project with the [Website](https://www.drupal.org/project/website) project template:

```shell
composer create-project drupal/website my_site
cd my_site && drush site:install recipes/website_starter
```

With DDEV:

```shell
ddev config --project-type=drupal --docroot=web
ddev start
ddev drush site:install recipes/website_starter -y
```

## After installation

- Build the page layout: *Structure > Page layouts* (`/admin/structure/page-layout`).
- Build the content displays: *Structure > Content types > Article > Manage display*.
- Browse the UIkit components: `/admin/appearance/ui/components/ui_suite_uikit`.
- Tune the design tokens: *Appearance > CSS variables > UI Suite UIkit*.

## Maintainers

- Rajab Natshah: [RajabNatshah](https://www.drupal.org/u/rajabnatshah)
