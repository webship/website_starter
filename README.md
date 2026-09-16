# Website Starter

A Drupal site template for company and product websites, built with
[Display Builder](https://www.drupal.org/project/display_builder) and the
[UI Suite UIkit](https://www.drupal.org/project/ui_suite_uikit) design system. Pages, blog listings and blog
posts are made of UIkit components arranged in Display Builder — no Canvas, no Layout Builder displays.

The site template works on its own: it applies the Web Admin, Web SEO, Web Security, Web Development, Web Page,
Web Assets, Web Blog, Web Editor and Web Config default recipes, the Web Dashboard recipe and core recipes, never
another site template.

![Website Starter](screenshot.webp)

## Install

Composer runs inside DDEV, so nothing is needed on your machine but DDEV itself. Start from the
[Website](https://www.drupal.org/project/website) project template, which ships this site template:

```shell
mkdir -p ~/workspace/projects/my-website
cd ~/workspace/projects/my-website
ddev config --project-type=drupal11 --docroot=web --php-version=8.4
ddev start
ddev composer create-project drupal/website:^1.0@alpha
ddev drush si -y webship --account-name=webmaster --site-name="My Website" installer_site_template_form.add_ons=website_starter
ddev launch
```

Or open the site with `ddev launch` and pick Website Starter in the installer.

On an installed site, apply it as a recipe:

```shell
ddev composer require drupal/website_starter:^1.0@alpha
ddev drush recipe ../recipes/website_starter
```

## What you get

- **Content types**: Webpage and Web Blog, with the media library (images, documents, audio, video) of Web
  Assets.
- **A page layout** built in Display Builder with UIkit components: sticky navbar with logo, main and account
  menus, offcanvas menu on small screens, content section and footer with menus, social links and copyright.
- **Content displays** built in Display Builder: blog posts as UIkit articles, blog teasers as UIkit cards, a
  paginated front page listing.
- **Contact webform** with anti-spam protection, at `/form/contact`.
- **Administration**: [Web Admin](https://www.drupal.org/project/webadmin) with Gin and its toolbar, Coffee,
  Project Browser and automatic updates; the Webmaster and Editorial default dashboards of the
  [Web Dashboard recipe](https://www.drupal.org/project/webdash), built with Display Builder.
- **SEO and security**: [Web SEO](https://www.drupal.org/project/webseo) with breadcrumbs, redirects, path
  aliases, metatags and the XML sitemap; [Web Security](https://www.drupal.org/project/websecurity) with anti-spam
  protection and login by email or username.
- **Editing and configuration**: the editor and configuration management features of Webship.
- **Design system**: the UI Suite UIkit theme with its UI Styles utilities, UI Skins design tokens (light and
  dark color modes) and UI Icons pack.
- **UIkit showcase**: the common pages of the free UIkit demos, in a *UIkit showcase* menu: a landing page,
  Features, Get started, Gallery (masonry grid and lightbox), Slideshows and Elements, with Support and Image
  credits pages in the footer. The images are the UIkit demo images (MIT) and NASA public domain photos.
- **Demo content**: About us, Privacy and Terms pages, 32 illustrated blog posts, a video, menus and footer
  links — imported as Drupal default content.

## Requirements

- Drupal 11.4 or later.
- PHP 8.3 or later.
- Composer 2.

## Tests

Automated functional tests use [webship-js](https://www.npmjs.com/package/webship-js) against a site
installed from this recipe:

```shell
npm install
LAUNCH_URL=https://my-site.ddev.site npm test
```

## Learn more

- [Display Builder documentation](https://project.pages.drupalcode.org/display_builder)
- [UI Suite UIkit components](https://www.drupal.org/project/ui_suite_uikit)
- [Drupal recipes](https://www.drupal.org/docs/extending-drupal/drupal-recipes)

## Maintainers

- Rajab Natshah: [RajabNatshah](https://www.drupal.org/u/rajabnatshah)
