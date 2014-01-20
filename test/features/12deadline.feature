Feature: Deadlines management
    Check that all deadline management has no errors

    Background:
        Given I can login as admin

    Scenario: Create a new deadline
        Given I am on "/scadenze.php"
        Then my page must be valid
        When I press "Save"
        Then I should see "This field is mandatory."
        When I fill hidden field "scadenza_data" with "2013-01-01"
        And I fill in "scadenza_descrizione_breve" with "TEST deadline"
        And I fill in "scadenza_descrizione_lunga" with "TEST long deadline text"
        And I attach the file "Document.pdf" to "scadenza_file"
        And I press "Save"
        Then I should be on "/scadenze.php"
        Then my page must be valid
        Then I should see "Deadline successfully saved."
        And I should not see "An error occured."

    Scenario: Show deadline and close
        Given I am on "/index.php"
        Then my page must be valid
        Then I should see "Jan 1, 2013"
        And I should see "TEST deadline"
        When I follow "View deadline"
        Then I should be on "/scadenza_dettagli.php"
        Then my page must be valid
        Then I should see "Jan 1, 2013"
        And I should see "TEST deadline"
        And I should see "TEST long deadline text"
        When I follow "Close"
        Then I should be on "/index.php"
        Then my page must be valid
        And I should see "Deadline successfully closed."

    Scenario: Create a new deadline for next test
        Given I am on "/scadenze.php"
        Then my page must be valid
        When I press "Save"
        Then I should see "This field is mandatory."
        When I fill hidden field "scadenza_data" with "2013-01-01"
        And I fill in "scadenza_descrizione_breve" with "TEST deadline 2"
        And I fill in "scadenza_descrizione_lunga" with "TEST long deadline text 2"
        And I press "Save"
        Then I should be on "/scadenze.php"
        Then my page must be valid
        Then I should see "Deadline successfully saved."

    Scenario: Close deadline from index
        Given I am on "/index.php"
        Then my page must be valid
        Then I should see "Jan 1, 2013"
        And I should see "TEST deadline 2"
        When I follow "Close deadline"
        Then I should be on "/index.php"
        Then my page must be valid
        And I should see "Deadline successfully closed."
