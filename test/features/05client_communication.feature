Feature: Client communication
  Letters for client communication generation

  Background:
      Given I can login as admin

  Scenario: Do not allow empty fields for letters
    Given I am on "/clienti_comunicazioni.php"
    Then my page must be valid
    When I press "Create"
    Then I should see "You must select at least one between owners or renters"

  Scenario: Letters for renters
    Given I am on "/clienti_comunicazioni.php"
    Then my page must be valid
    When I check "affittuari"
    And I fill in "contratto_dal_user" with "2013-01-01"
    And I fill in "contratto_al_user" with "2013-06-01"
    And I press "Create"
    Then response should be RTF

  Scenario: Letters for owners
    Given I am on "/clienti_comunicazioni.php"
    Then my page must be valid
    When I check "proprietari"
    And I press "Create"
    Then response should be RTF

  Scenario: Letters for all types
    Given I am on "/clienti_comunicazioni.php"
    Then my page must be valid
    When I check "proprietari"
    And I check "affittuari"
    And I fill in "contratto_dal_user" with "2013-01-01"
    And I fill in "contratto_al_user" with "2013-03-31"
    And I press "Create"
    Then response should be RTF

  Scenario: Do not allow empty fields for labels
    Given I am on "/clienti_etichette.php"
    Then my page must be valid
    When I press "Create"
    Then I should see "You must select at least one between owners, renters or present"

  Scenario: Labels for renters
    Given I am on "/clienti_etichette.php"
    Then my page must be valid
    When I check "affittuari"
    And I fill in "contratto_fine_user" with "2013-01-01"
    And I fill in "contratto_fine_user" with "2013-06-01"
    And I press "Create"
    Then response should be RTF

  Scenario: Letters for owners
    Given I am on "/clienti_etichette.php"
    Then my page must be valid
    When I check "proprietari"
    And I press "Create"
    Then response should be RTF

  Scenario: Labels for present
    Given I am on "/clienti_etichette.php"
    Then my page must be valid
    When I check "presenze"
    And I fill in "contratto_fine_user" with "2013-01-01"
    And I fill in "contratto_fine_user" with "2013-06-01"
    And I press "Create"
    Then response should be RTF

  Scenario: Labels for all types
    Given I am on "/clienti_etichette.php"
    Then my page must be valid
    When I check "proprietari"
    And I check "affittuari"
    And I check "presenze"
    And I fill in "contratto_fine_user" with "2013-01-01"
    And I fill in "contratto_fine_user" with "2013-03-31"
    And I press "Create"
    Then response should be RTF
