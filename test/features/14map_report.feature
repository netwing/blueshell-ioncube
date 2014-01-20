Feature: Map report
    Check that all map report has no errors

    Background:
        Given I can login as admin

    Scenario Outline: No errors on pages
        Given I am on "/index.php"
        When I follow "<link>"
        Then response should be TXT

    Examples:
        | link |
        | Free (port) |
        | Free (manage) |
        | Rented (port) |
        | Rented (manage) |
        | Booked (port) |
        | Booked (manage) |
        | Sold |
        | Optioned |
