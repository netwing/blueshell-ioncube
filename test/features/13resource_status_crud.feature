Feature: Resources group and resources management and reports
    Operation for resources status and presence

    Background:
        Given I can login as admin

    Scenario: Print presence report
        Given I am on "/report_presenze.php"
        Then my page must be valid
        Given I am on "/report_presenze.php?id=7"
        Then my page must be valid
        When I press "Create"
        Then I should be on "/report_presenze.php?id=7"
        Then my page must be valid
        And I should see "No enabled resources for selected group."
        Given I am on "/report_presenze.php?id=1"
        Then my page must be valid
        When I select "A" from "pontile"
        And I fill hidden field "data_presenza_dal" with "1990-01-01"
        And I fill hidden field "data_presenza_al" with "1990-01-31"
        When I press "Create"
        Then I should be on "/report_presenze.php?id=1"
        Then my page must be valid
        And I should see "No presences for selected group and dates."
        Given I am on "/report_presenze.php?id=0"
        Then my page must be valid
        When I select "A" from "pontile"
        And I fill hidden field "data_presenza_dal" with "2010-01-01"
        And I fill hidden field "data_presenza_al" with "2010-01-31"
        And I press "Create"
        Then I should be on "/report_presenze.php?id=0"
        And response should be RTF

    Scenario: Print arrival report
        Given I am on "/report_arrivi.php"
        Then my page must be valid
        Given I am on "/report_arrivi.php?id=7"
        Then my page must be valid
        When I press "Create"
        Then I should be on "/report_arrivi.php?id=7"
        Then my page must be valid
        And I should see "No enabled resources for selected group."
        Given I am on "/report_arrivi.php?id=1"
        Then my page must be valid
        When I press "Create"
        Then I should be on "/report_arrivi.php?id=1"
        Then my page must be valid
        When I select "A" from "pontile"
        And I fill hidden field "inizio_dal" with "1990-01-01"
        And I fill hidden field "inizio_al" with "1990-01-31"
        When I press "Create"
        Then I should be on "/report_arrivi.php"
        And I should see "No arrivals for selected group and dates."
        Given I am on "/report_arrivi.php?id=0"
        Then my page must be valid
        When I select "A" from "pontile"
        And I fill hidden field "inizio_dal" with "2010-01-01"
        And I fill hidden field "inizio_al" with "2010-12-31"
        And I press "Create"
        Then I should be on "/report_arrivi.php?id=0"
        And response should be RTF

    Scenario: Print departure report
        Given I am on "/report_partenze.php"
        Then my page must be valid
        Given I am on "/report_partenze.php?id=7"
        Then my page must be valid
        When I press "Create"
        Then I should be on "/report_partenze.php?id=7"
        Then my page must be valid
        And I should see "No enabled resources for selected group."
        Given I am on "/report_partenze.php?id=1"
        Then my page must be valid
        When I press "Create"
        Then I should be on "/report_partenze.php?id=1"
        Then my page must be valid
        When I select "A" from "pontile"
        And I fill hidden field "inizio_dal" with "1990-01-01"
        And I fill hidden field "inizio_al" with "1990-01-31"
        When I press "Create"
        Then I should be on "/report_partenze.php"
        And I should see "No departures for selected group and dates."
        Given I am on "/report_partenze.php?id=0"
        Then my page must be valid
        When I select "A" from "pontile"
        And I fill hidden field "inizio_dal" with "2010-01-01"
        And I fill hidden field "inizio_al" with "2010-12-31"
        And I press "Create"
        Then I should be on "/report_partenze.php?id=0"
        And response should be RTF

    Scenario: Resources status and presence change
        Given I am on "/posti_barca_status.php"
        Then my page must be valid
        Given I am on "/posti_barca_status.php"
        When I follow "Disable presence"
        Then I should be on "/posti_barca_status.php"
        Then my page must be valid
        And I should not see "An error occured."
        And I should see "Presence successfully changed."
        When I follow "Enable presence"
        Then I should be on "/posti_barca_status.php"
        Then my page must be valid
        And I should not see "An error occured."
        And I should see "Presence successfully changed."

    Scenario: Resource details
        Given I am on "/posto_barca_dettagli.php?id=1"
        Then my page must be valid
        Given I am on "/posto_barca_dettagli.php?id=100"
        Then my page must be valid
        Given I am on "/posto_barca_dettagli.php?id=1000"
        Then my page must be valid
        Given I am on "/posto_barca_dettagli.php?id=2001"
        Then my page must be valid

    Scenario: Resource group print report
        Given I am on "/posti_barca.php?id=1"
        Then my page must be valid
        When I follow "Print group report"
        Then response should be RTF


