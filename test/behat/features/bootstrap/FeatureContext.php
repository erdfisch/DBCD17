<?php
/**
 * Behat feature class.
 *
 * @file Feature class for implementing custom test logic.
 */
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Mink\Driver\Selenium2Driver;
use Drupal\DrupalExtension\Context\RawDrupalContext;

error_reporting(error_reporting() & ~E_USER_DEPRECATED);


class FeatureContext extends RawDrupalContext implements Context, SnippetAcceptingContext {

  /**
   * FeatureContext constructor.
   */
  public function __construct($screenshot_path) {
    $this->screenshotPath = $screenshot_path;

  }

  /**
   * Take screen-shot when step fails. Works only with Selenium2Driver.
   *
   * @AfterStep
   * @param AfterStepScope $scope
   */
  public function takeScreenshotAfterFailedStep(AfterStepScope $scope) {
    if (99 === $scope->getTestResult()->getResultCode()) {
      $driver = $this->getSession()->getDriver();

      if (!$driver instanceof Selenium2Driver) {
        return;
      }

      $screenshotPath = empty($this->screenshotPath) ? './tmp/behat' : $this->screenshotPath;
      $screenshotPath = rtrim($screenshotPath, '/');

      $scenario = current($scope->getFeature()->getScenarios());
      $path = [];
      $path['feature'] = $scope->getFeature()->getTitle();
      $path['scenario'] = $scenario->getTitle();
      $path = preg_replace('/[^\-\.\w]/', '_', $path);
      if (!is_dir($screenshotPath . '/' . $path['feature'])) {
        mkdir($screenshotPath . '/' . $path['feature'], 0777, TRUE);
      }
      $filename = implode('/', $path) . '.jpg';

      $this->saveScreenshot($filename, $screenshotPath);
    }
  }

}
