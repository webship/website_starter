Feature: The Display Builder page layout built with UIkit components
  As a visitor
  I want every page to share the UIkit navbar, content section and footer
  So that the website looks consistent

  Scenario: The navbar, the content section and the footer are UIkit components
    Given I am an anonymous user
     When I go to the homepage
     Then ".uk-navbar-container" should be visible
      And ".uk-navbar-left .uk-logo" should be visible
      And ".uk-navbar-center .uk-navbar-nav" should contain text "Blog"
      And ".uk-navbar-center .uk-navbar-nav" should contain text "About us"
      And ".uk-navbar-center .uk-navbar-nav" should contain text "UIkit showcase"
      And ".uk-navbar-center .uk-navbar-nav" should contain text "Contact"
      And "footer, .uk-section-secondary" should contain text "Privacy"
      And ".uk-section-secondary" should contain text "Github"
      And ".uk-section-secondary" should contain text "Copyright"
      And the computed style "background-color" of ".uk-section-secondary" should be "rgb(34, 34, 34)"
      And there should be no JavaScript errors

  Scenario: The offcanvas menu is used on small screens
    Given I am an anonymous user
      And I set the viewport to the "xs" breakpoint
     When I go to the homepage
     Then ".uk-navbar-center .uk-navbar-nav" should be hidden
     When I click on the element ".uk-navbar-toggle"
     Then "#website-offcanvas .uk-offcanvas-bar" should be visible within 5 seconds
      And "#website-offcanvas .uk-nav-primary" should contain text "About us"
