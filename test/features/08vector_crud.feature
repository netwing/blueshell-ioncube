Feature: Vector management
  CRUD operation for vector

  Background:
      Given I can login as admin

  Scenario: Create and read vector
    Given I am on "/barca_inserimento.php?id=0"
    When I press "Save"
    Then I must have no errors    
    Then I should see "This field is mandatory."
    When I fill in "barca_nome" with "AAAAA-vectorjustfortest"
    And I fill in "barca_lunghezza" with "10"
    And I select "1" from "barca_tipologia_barca"
    And I fill in "barca_proprietario" with "1"
    And I select "concludi" from "procedere2"
    And I press "Save"
    Then I must have no errors    
    Then I should see "Vector created successfully."
    Given I am on "/barche.php?iniziale=A&pag=0"
    Then I should see "AAAAA-vectorjustfortest"
  
  Scenario: Update vector
    Given I am on "/barche.php?iniziale=A&pag=0"
    Then I should see "AAAAA-vectorjustfortest"
    When I fill in "ricerca" with "AAAAA-vectorjustfortest"
    And I press "Go"
    Then I must have no errors    
    Then I should be on "/cerca.php"
    Then I should see "AAAAA-vectorjustfortest"
    When I follow "Edit"
    And I fill in "barca_nome" with "AAAAA-vectorjustfortest-updated"
    And I press "Save"
    Then I must have no errors    
    Then I should be on "/barche.php"
    Then I should see "Vector updated successfully."
    Given I am on "/barche.php?iniziale=A&pag=0"
    Then I should see "AAAAA-vectorjustfortest-updated"
    When I fill in "ricerca" with "AAAAA-vectorjustfortest-updated"
    And I press "Go"
    Then I must have no errors    
    Then I should be on "/cerca.php"
    Then I should see "AAAAA-vectorjustfortest-updated"
    When I follow "Edit"
    And I fill in "barca_nome" with "AAAAA-vectorjustfortest"
    And I press "Save"
    Then I must have no errors    
    Then I should be on "/barche.php"
    Then I should see "Vector updated successfully."
    Given I am on "/barche.php?iniziale=A&pag=0"
    Then I should see "AAAAA-vectorjustfortest"

  Scenario: Delete vector
    Given I am on "/barche.php?iniziale=A&pag=0"
    Then I should see "AAAAA-vectorjustfortest"
    When I fill in "ricerca" with "AAAAA-vectorjustfortest"
    And I press "Go"
    Then I must have no errors    
    Then I should be on "/cerca.php"
    Then I should see "AAAAA-vectorjustfortest"
    When I follow "Delete"
    Then I should see "This vector was unused in the system and can be safely deleted."
    When I press "vector_delete_confirm"
    Then I must have no errors    
    Then I should be on "/barche.php"
    And I should see "Vector deleted successfully."

