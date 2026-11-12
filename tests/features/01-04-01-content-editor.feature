Feature: Content editor
  As a content editor
  I want to edit the demo content of the site template
  So that I can change the pages the template installs without the administrator

  Scenario: The content editor can edit and save the About us page
    Given I am a logged in user with the "Content editor" user
     When I go to "/admin/content"
     Then I should see the "Edit" operation for the "About us" content
     When I open the "Edit" operation in the "About us" row
      And I save the content
     Then I should see "has been updated."
