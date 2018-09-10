Feature: weather

Scenario: I can get weather report
    Given I can see weather
    Then I can see its success
    Then I can see http code as 200
    Then I can see message

Scenario: I can get weather report validation error
    Then I cant see its success
    Then I should get http code as 422
    Then I should get validation message
