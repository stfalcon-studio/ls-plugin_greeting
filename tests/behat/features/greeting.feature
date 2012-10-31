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
                     When I follow "Добро пожаловать на наш сайт!"
                         Then I should see "Здравствуйте, test_livestreet_user."
                         Then I should see "Рады приветствовать вас на нашем сайте!"
                         Then I should see "Если у вас возникли вопросы по пользованию сайтом, тогда можете задавать их здесь или поискать на этой странице. "
                            Then I wait