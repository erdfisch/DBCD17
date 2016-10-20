@api @javascript @base
Feature: Grundfunktionen

  Scenario: Site is reachable
    Given I go to "/"
    Then I should get a "200" HTTP response
