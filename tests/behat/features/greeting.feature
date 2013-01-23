Feature: Greeting plugin standart features BDD
  Test base functionality of LiveStreet greeting plugin standart

@mink:selenium2
    Scenario: Registration new User for LiveStreet CMS
        Given I am on "/registration/"
            When I fill in "registration-login" with "ls-user"
            And I fill in "registration-mail" with "livestreet@info.com"
            And I fill in "registration-user-password" with "qwerty"
            And I fill in "registration-user-password-confirm" with "qwerty"
            And I press "registration-form-submit"
            Then I wait "1000"

        Given I am on "/talk/inbox/new/"
            Then I wait "2000"
            Then I should see "Welcome to our site!"
            Then I wait "2000"
            When I follow "Welcome to our site!"
            And I should see "Welcome to our site!"
            And I should see "If you have any questions about using the website, then you can ask them here or search for answers on this page."
            And I should see "/page/about">this page</a>"