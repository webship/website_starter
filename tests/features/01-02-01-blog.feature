Feature: The Web Blog with Display Builder displays
  As a visitor
  I want to browse the blog posts as UIkit cards and read them as UIkit articles
  So that I can read the website news

  Scenario: The front page lists the blog posts as cards over 4 pages
    Given I am an anonymous user
      And I set the viewport to the "xxl" breakpoint
     When I go to the homepage
     Then "h1" should have a count of 1
      And "[role='main'] h1" should contain text "Blog"
      And "[data-component-id='ui_suite_uikit:card']" should have a count of 10
      And ".uk-pagination" should be visible
      And ".uk-pagination" should contain text "4"
      And the page should not contain escaped markup
     When I go to "/?page=3"
     Then "[data-component-id='ui_suite_uikit:card']" should have a count of 2
      And ".uk-pagination li.uk-active" should contain text "4"

  Scenario: A blog post is a UIkit article with its image
    Given I am an anonymous user
     When I go to "/blog/getting-started-uikit"
     Then "[data-component-id='ui_suite_uikit:article']" should be visible
      And ".uk-article-meta" should contain text "By"
      And "[data-component-id='ui_suite_uikit:article'] img" should be visible
      And "h1" should contain text "Getting started with UIkit"
      And the page should not contain escaped markup
