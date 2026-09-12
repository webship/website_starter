Feature: Webpages and the contact webform
  As a visitor
  I want to read the website pages and contact the website team
  So that I know who they are and can reach them

  Scenario Outline: The webpages are published
    Given I am an anonymous user
     When I go to "<path>"
     Then "h1" should contain text "<title>"
      And the page should not contain escaped markup

    Examples:
      | path                 | title          |
      | /about-us            | About us       |
      | /privacy             | Privacy        |
      | /terms               | Terms          |
      | /welcome             | UIkit showcase |
      | /features            | Features       |
      | /get-started         | Get started    |
      | /showcase/gallery    | Gallery        |
      | /showcase/slideshows | Slideshows     |
      | /showcase/elements   | Elements       |
      | /support             | Support        |
      | /image-credits       | Image credits  |

  Scenario: The UIkit showcase pages use the UIkit components
    Given I am an anonymous user
     When I go to "/showcase/gallery"
     Then "[uk-lightbox]" should be visible
      And the page should not contain escaped markup
     When I go to "/showcase/slideshows"
     Then "[uk-slideshow]" should be visible
      And "[uk-slider]" should be visible
     When I go to "/welcome"
     Then ".uk-cover-container" should be visible
      And there should be no JavaScript errors

  Scenario: The contact webform uses the UIkit form styles
    Given I am an anonymous user
     When I go to "/form/contact"
     Then "input[name='name']" should have class "uk-input"
      And "input[name='email']" should have class "uk-input"
      And "textarea[name='message']" should have class "uk-textarea"
      And I should see "We'd love to talk to you"
      And I should see "Privacy policy"

  Scenario: The site is built with Display Builder, without Canvas
    Given I am an anonymous user
     When I go to the homepage
     Then the Drupal page "/" should contain "Display Builder Page Layout"
      And the Drupal page "/" should not contain "/modules/contrib/canvas/"
      And the Drupal page "/" should not contain "/core/modules/layout_builder/"
