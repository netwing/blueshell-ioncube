Feature: Vector insurance management
    Check if we can generate vector expiring insurance letters

  Background:
      Given I can login as admin

    Scenario: Create expire insurance letters
        Given I am on "/assicurazioni_in_scadenza.php"
        When I follow "Create expire insurance letters"
        Then I should be on "/assicurazioni_scadenze.php"

    Scenario: Check letters generation
        Given I am on "/assicurazioni_scadenze.php"
        When I fill in hidden field "assicurazione_fine_dal" with "2013-01-01"
        When I fill in hidden field "assicurazione_fine_al" with "2013-02-28"
        And I press "Create"
        Then response should be RTF

    Scenario: Check report generation
        Given I am on "/assicurazioni_scadenze.php"
        When I fill in hidden field "assicurazione_fine_dal" with "2013-01-01"
        When I fill in hidden field "assicurazione_fine_al" with "2013-02-28"
        And I check "rapporto"
        And I press "Create"
        Then response should be RTF

