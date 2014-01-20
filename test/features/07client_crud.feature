Feature: Client management
  CRUD operation for client

  Background:
      Given I can login as admin

  Scenario: Create and read client
    Given I am on "/cliente_inserimento.php"
    When I press "Save"
    Then I should see "This field is mandatory."
    When I fill in "cliente_nominativo" with "AAAAA-justfortest"
    And I fill in "cliente_telefono1" with "AAAAA-12345678"
    And I select "concludi" from "procedere"
    And I press "Save"
    Then I should see "This field can contain only numbers!"
    When I fill in "cliente_nominativo" with "AAAAA-justfortest"
    And I fill in "cliente_telefono1" with "12345678"
    And I select "concludi" from "procedere"
    And I press "Save"
    Then I must have no errors    
    Then I should see "Client created successfully."
    Given I am on "/clienti.php?iniziale=A&pag=0"
    Then I should see "AAAAA-justfortest"

  Scenario: Update client
    Given I am on "/clienti.php?iniziale=A&pag=0"
    Then I should see "AAAAA-justfortest"
    When I fill in "ricerca" with "AAAAA-justfortest"
    And I press "Go"
    Then I must have no errors    
    Then I should be on "/cerca.php"
    Then I should see "AAAAA-justfortest"
    When I follow "Edit"
    And I fill in "cliente_nominativo" with "AAAAA-justfortest-updated"
    And I select "concludi" from "procedere"
    And I press "Save"
    Then I must have no errors    
    Then I should be on "/clienti.php"
    Then I should see "Client updated successfully."
    Given I am on "/clienti.php?iniziale=A&pag=0"
    Then I should see "AAAAA-justfortest-updated"
    When I fill in "ricerca" with "AAAAA-justfortest-updated"
    And I press "Go"
    Then I must have no errors    
    Then I should be on "/cerca.php"
    Then I should see "AAAAA-justfortest-updated"
    When I follow "Edit"
    And I fill in "cliente_nominativo" with "AAAAA-justfortest"
    And I select "concludi" from "procedere"
    And I press "Save"
    Then I must have no errors    
    Then I should be on "/clienti.php"
    Then I should see "Client updated successfully."
    Given I am on "/clienti.php?iniziale=A&pag=0"
    Then I should see "AAAAA-justfortest"

  Scenario: Delete client
    Given I am on "/clienti.php?iniziale=A&pag=0"
    Then I should see "AAAAA-justfortest"
    When I fill in "ricerca" with "AAAAA-justfortest"
    And I press "Go"
    Then I must have no errors    
    Then I should be on "/cerca.php"
    Then I should see "AAAAA-justfortest"
    When I follow "Delete"
    Then I should see "This client was unused in the system and can be safely deleted."
    When I press "client_delete_confirm"
    Then I must have no errors    
    Then I should be on "/clienti.php"
    And I should see "Client deleted successfully."

