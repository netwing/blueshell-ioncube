Feature: Contract management
    Check that all contract management has no errors

    Background:
        Given I can login as admin

    Scenario: Print annual report
        Given I am on "/rapporto_annuale.php"
        Then my page must be valid
        When I press "Download monthly report"
        Then response should be TXT
        Given I am on "/rapporto_annuale.php"
        Then my page must be valid
        Then I should see "Download invoices report"
        When I press "Download invoices report"
        Then response should be TXT

    Scenario Outline: No errors on pages
        Given I am on "<page>"
        Then my page must be valid

    Examples:
        | page |
        | contratti.php |
        | riepilogo.php?id=1 |
        | riepilogo.php?id=100 |
        | riepilogo.php?id=1002 |
        | riepilogo.php?id=1906 |
        | riepilogo.php?id=4110 |
        | riepilogo.php?id=6892 |
        | riepilogo.php?id=16708 |
        | contratto_nuovo.php |

    Scenario: Print contract report
        Given I am on "/report_contratti.php"
        Then my page must be valid
        When I select "inizio" from "inizio_fine"
        When I fill hidden field "dal" with "1990-01-01"
        When I fill hidden field "al" with "1990-01-31"
        When I select "informativo" from "report_tipo"
        When I press "Create"
        Then response should be RTF
        Given I am on "/report_contratti.php"
        Then my page must be valid
        When I select "fine" from "inizio_fine"
        When I fill hidden field "dal" with "1990-01-01"
        When I fill hidden field "al" with "1990-01-31"
        When I select "informativo" from "report_tipo"
        When I press "Create"
        Then response should be RTF
        Given I am on "/report_contratti.php"
        Then my page must be valid
        When I select "inizio" from "inizio_fine"
        When I fill hidden field "dal" with "1990-01-01"
        When I fill hidden field "al" with "1990-01-31"
        When I select "fatturato" from "report_tipo"
        When I press "Create"
        Then response should be RTF
        Given I am on "/report_contratti.php"
        Then my page must be valid
        When I select "fine" from "inizio_fine"
        When I fill hidden field "dal" with "1990-01-01"
        When I fill hidden field "al" with "1990-01-31"
        When I select "fatturato" from "report_tipo"
        When I press "Create"
        Then response should be RTF

#    @javascript
#    Scenario: Create a new contract
#        Given I am on "/contratto_nuovo.php"
#        Then my page must be valid 
#        When I select "1" from "contratto_tipo"
#        When I select "annuale" from "contratto_periodo"
#        When I fill hidden field "contratto_data" with "2013-01-01"
#        When I fill hidden field "contratto_inizio" with "2013-02-01"
#        When I fill hidden field "contratto_fine" with "2014-02-01"
#        When I fill "contratto_anagrafica1" with "Seaser"
#        Then I should see "Seaser Spa ()"
#        When I click on "Seaser Spa ()"
#        Then I should see "Seaser Spa ()"

