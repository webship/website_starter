<?php

/**
 * @file
 * Generates the Website Starter default content on a development site.
 *
 * Usage (from the Drupal project, the recipe in recipes/website_starter):
 * @code
 * drush site:install ../recipes/website_starter -y
 * drush php:script ../recipes/website_starter/scripts/generate-content.php
 * cd recipes/website_starter/content && rm -rf node menu_link_content taxonomy_term file/*.yml && cd -
 * drush content:export node --with-dependencies --dir=/var/www/html/recipes/website_starter/content
 * drush content:export menu_link_content --dir=/var/www/html/recipes/website_starter/content
 *
 * The images to attach are the *.jpg files of content/file.
 * @endcode
 */

declare(strict_types=1);

use Drupal\file\Entity\File;
use Drupal\menu_link_content\Entity\MenuLinkContent;
use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;

$recipe_dir = dirname(__DIR__);
$file_system = \Drupal::service('file_system');

$lorem = [
  'UIkit is a lightweight and modular front-end framework for developing fast and powerful web interfaces.',
  'Display Builder lets site builders compose pages from design system components, with a live preview.',
  'Every component is a Single Directory Component with typed props, slots, variants and stories.',
  'Design tokens are CSS variables: change the brand colors once and every component follows.',
  'Layouts are components too: sections, containers and grids with ratios chosen from the variants.',
  'Accessible markup, keyboard navigation and color contrast are built into the components.',
];

// Images, as file entities.
$images = [];
$directory = 'public://website-starter';
$file_system->prepareDirectory($directory, \Drupal\Core\File\FileSystemInterface::CREATE_DIRECTORY);
foreach (glob($recipe_dir . '/content/file/*.jpg') as $path) {
  $name = basename($path);
  $uri = $file_system->copy($path, "$directory/$name", \Drupal\Core\File\FileExists::Replace);
  $file = File::create(['uri' => $uri, 'filename' => $name, 'status' => 1, 'uid' => 1]);
  $file->save();
  $images[] = $file;
}

// Tags.
$tags = [];
foreach (['UIkit', 'Display Builder', 'Components', 'Design system', 'Drupal'] as $name) {
  $term = Term::create(['vid' => 'tags', 'name' => $name]);
  $term->save();
  $tags[] = $term;
}

// Pages, with main menu links.
$pages = [
  'About' => 'We build websites with Drupal, Display Builder and the UIkit design system.',
  'Services' => 'Design systems, component libraries, page layouts and content displays built for site builders.',
  'Contact' => 'Write to us at hello@example.com, or visit us at 1 Example Street.',
];
$weight = 0;
foreach ($pages as $title => $text) {
  $alias = '/' . strtolower($title);
  $node = Node::create([
    'type' => 'page',
    'title' => $title,
    'uid' => 1,
    'status' => 1,
    'path' => ['alias' => $alias],
    'body' => [
      'value' => "<p class=\"uk-text-lead\">$text</p><p>" . implode('</p><p>', $lorem) . '</p>',
      'format' => 'basic_html',
    ],
  ]);
  $node->save();
  MenuLinkContent::create([
    'title' => $title,
    'link' => ['uri' => 'entity:node/' . $node->id()],
    'menu_name' => 'main',
    'weight' => ++$weight,
  ])->save();
  if ($title !== 'Services') {
    MenuLinkContent::create([
      'title' => $title,
      'link' => ['uri' => 'entity:node/' . $node->id()],
      'menu_name' => 'footer',
      'weight' => $weight,
    ])->save();
  }
}

// Articles: 24 articles, 3 pages of the front page listing (10 per page).
$titles = [
  'Getting started with UIkit', 'Building pages with Display Builder', 'A tour of the UIkit components',
  'Design tokens in practice', 'Responsive layouts with grids', 'Accessible navigation patterns',
  'Cards, tiles and sections', 'Menus in the navbar and offcanvas', 'Theming with CSS variables',
  'Stories and the component library', 'From Figma and Penpot to components', 'Slideshows and sliders',
  'Accordions, switchers and modals', 'Forms styled with UIkit', 'Icons from the UIkit icon pack',
  'Dark mode with UI Skins', 'Utility classes with UI Styles', 'Page layouts without Layout Builder',
  'Content displays with components', 'Views with Display Builder', 'Testing themes with webship-js',
  'Shipping a design system', 'Recipes for faster websites', 'What is next for the Website Starter',
];
$created = \Drupal::time()->getRequestTime() - count($titles) * 86400;
foreach ($titles as $index => $title) {
  $image = $images[$index % max(1, count($images))] ?? NULL;
  $node = Node::create([
    'type' => 'article',
    'title' => $title,
    'uid' => 1,
    'status' => 1,
    'promote' => 1,
    'created' => $created + $index * 86400,
    'path' => ['alias' => '/blog/' . preg_replace('/[^a-z0-9]+/', '-', strtolower($title))],
    'body' => [
      'summary' => $lorem[$index % count($lorem)],
      'value' => '<p>' . implode('</p><p>', array_merge(array_slice($lorem, $index % count($lorem)), array_slice($lorem, 0, $index % count($lorem)))) . '</p>',
      'format' => 'basic_html',
    ],
    'field_image' => $image ? ['target_id' => $image->id(), 'alt' => $title] : [],
    'field_tags' => [
      ['target_id' => $tags[$index % count($tags)]->id()],
      ['target_id' => $tags[($index + 2) % count($tags)]->id()],
    ],
  ]);
  $node->save();
}

echo sprintf("Generated %d images, %d tags, %d pages, %d articles.\n", count($images), count($tags), count($pages), count($titles));
