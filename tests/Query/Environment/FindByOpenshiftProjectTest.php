<?php

namespace Lagoon\Test\Query\Environment;

use PHPUnit\Framework\TestCase;
use Lagoon\Query\Environment\FindByOpenshiftProject;
use Lagoon\LagoonClient;

/**
 * Test the fetch all query.
 */
class FindByOpenshiftProjectTest extends TestCase {

  /**
   * The client.
   *
   * @var Lagoon\LagoonClient
   */
  protected $client;

  /**
   * Reflection method call.
   */
  public function callMethod($obj, $name, array $args = []) {
    $class = new \ReflectionClass($obj);
    $method = $class->getMethod($name);
    $method->setAccessible(true);
    return $method->invokeArgs(new $obj($this->client), $args);
  }

  /**
   * Set up the test case.
   */
  public function setup() {
    $client = $this->getMockBuilder(LagoonClient::class)
      ->disableOriginalConstructor()
      ->getMock();

    $this->client = $client;
  }

  /**
   * Test that the expected keys match.
   */
  public function testExpectedKeys() {
    $expected_keys = $this->callMethod(FindByOpenshiftProject::class, 'expectedKeys');
    $this->assertEquals(['openshiftProjectName'], $expected_keys);
  }

  /**
   * Test that the query matche what is expected.
   */
  public function testQuery() {
    $query = <<<QUERY
query EnvironmentByOpenshiftProjectName(\$openshiftProjectName: string) {
  environmentByOpenshiftProjectName(openshiftProjectName: \$openshiftProjectName) {
    %s
  }
}
QUERY;

    $called = $this->callMethod(FindByOpenshiftProject::class, 'query');
    $this->assertEquals($query, $called);
  }
}
