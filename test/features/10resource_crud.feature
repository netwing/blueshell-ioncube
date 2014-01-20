Feature: Resources group and resources management
    CRUD operation for resources group

    Background:
        Given I can login as admin

    Scenario: Create resource group
        Given I am on "/pontili.php"
        When I press "Add resource"
        Then I should see "This field is mandatory."
        And I must have no errors    
        When I fill in "pontile_codice" with "TT"
        And I fill in "nome" with "Test 1"
        And I press "Add resource"
        Then I should see "Resource group successfully created."
        And I must have no errors    
        When I fill in "pontile_codice" with "TT"
        And I press "Add resource"
        Then I should see "Resource group with this code already exists, please choose another code."
        And I must have no errors  

    Scenario: Read resource group
        Given I am on "/pontili.php"
        When I follow "view-TT"
        Then I should be on "/posti_barca.php"
        And I must have no errors  

    Scenario: Delete resource group
        Given I am on "/pontili.php"
        When I follow "delete-TT"
        Then I should be on "/pontile_elimina.php"
        And I must have no errors  
        And I should see "This resource group was unused in the system and can be safely deleted."
        When I press "pontile_delete_confirm"
        Then I should be on "/pontili.php"
        And I must have no errors  
        And I should see "Resource group deleted successfully."
        And I should not see "Test 1"

    Scenario: Create resource 
        Given I am on "/posti_barca.php?pontile=1"
        When I press "Add resource"
        Then I should see "This field is mandatory."
        And I must have no errors    
        When I fill in "posto_barca_numero" with "0"
        And I select "16 x 3" from "posto_barca_dimensioni"
        And I press "Add resource"
        Then I should see "Resource updated successfully."
        And I should see "A0"
        And I should be on "/posti_barca.php?pontile=1"
        And I must have no errors    

    Scenario: Enable and disable resource 
        Given I am on "/posti_barca.php?pontile=1"
        When I follow "disable-A0"
        Then I should see "Resource disabled successfully."
        And I must have no errors    
        When I follow "enable-A0"
        Then I should see "Resource enabled successfully."
        And I must have no errors    

    Scenario: Delete resource 
        Given I am on "/posti_barca.php?pontile=1"
        When I follow "delete-A0"
        Then I should see "Resource deleted successfully."
        And I must have no errors    
        Then I should not see "A0"

    Scenario: Resource group report generation
        Given I am on "/posti_barca.php?pontile=1"
        When I follow "Print group report"
        Then response should be RTF



