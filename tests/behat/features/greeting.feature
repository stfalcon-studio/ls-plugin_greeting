Feature: Greeting plugin standart features BDD
  Test base functionality of LiveStreet greeting plugin standart

@mink:selenium2
  Scenario: Registration new User for LiveStreet CMS
    Given I am on "/registration/"
     When I fill in "registration-login" with "test_livestreet_user"
     When I fill in "registration-mail" with "livestreet@info.com"
     When I fill in "registration-user-password" with "qwerty"
     When I fill in "registration-user-password-confirm" with "qwerty"
     When I press "registration-form-submit"
     Then I wait
    Given I am on "/talk/inbox/new/"
     Then I should see "Добро пожаловать на наш сайт!"
     Then I wait