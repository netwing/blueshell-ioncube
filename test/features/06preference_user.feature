Feature: User management
  CRUD operation for user

  Background:
      Given I can login as admin

  Scenario: Try to create a new user
    Given I am on "/preferenze_utenti.php"
    When I follow "Create new user"
    Then the "h1" element should contain "Create new user"

  Scenario: With new user, the username field was mandatory
    Given I am on "/user_create.php"
    When I press "Save"
    Then I should see "This field is mandatory."

  Scenario: Check username already used
    Given I am on "/user_create.php"
    When I fill in "utente_username" with "admin"
    And I fill in "utente_password" with "password"
    And I press "Save"
    Then I should see "This username was already taken."

  Scenario: Create new user
    Given I am on "/user_create.php"
    When I fill in "utente_username" with "anewuserusedjustfortest"
    And I fill in "utente_password" with "password"
    And I select "R" from "utente_accesso_principale"
    And I press "Save"
    Then I should see "User created successfully."

  Scenario: Test login with user and his permissions
    Given I am on "/login.php?logout=1"
    When I fill in "username" with "anewuserusedjustfortest"
    And  I fill in "password" with "password"
    And I press "Sign in"
    Then I should not see "Username not found or invalid password."
    And I should see "Login successful, welcome back."
    And I should not see "Access denied"
    And I should not see "You can't view this page."
    When I follow "Settings"
    Then I should see "Access denied"
    And I should see "You can't view this page."

  Scenario: Update
    Given I am on "/preferenze_utenti.php"
    When I follow "update-anewuserusedjustfortest"
    And I fill in "utente_password" with "anewpassword"
    And I press "Save"
    Then I should see "User updated successfully."

  Scenario: Test login with user with changed password
    Given I am on "/login.php?logout=1"
    When I fill in "username" with "anewuserusedjustfortest"
    And  I fill in "password" with "anewpassword"
    And I press "Sign in"
    Then I should not see "Username not found or invalid password."
    And I should see "Login successful, welcome back."

  Scenario: Delete user
    Given I am on "/preferenze_utenti.php"
    When I follow "delete-anewuserusedjustfortest"
    Then I should see "User deleted successfully."


