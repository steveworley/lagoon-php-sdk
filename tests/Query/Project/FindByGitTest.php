<?php

namespace Lagoon\Test\Query\Project;

use PHPUnit\Framework\TestCase;
use Lagoon\Query\Project\FindByGit;
use Lagoon\LagoonClient;

/**
 * Test the fetch all query.
 */
class FindByGitTest extends TestCase {

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
    $expected_keys = $this->callMethod(FindByGit::class, 'expectedKeys');
    $this->assertEquals(['gitUrl'], $expected_keys);
  }

  /**
   * Test that the query matche what is expected.
   */
  public function testQuery() {
    $query = <<<QUERY
query ProjectByGit(\$gitUrl: string) {
  projectByGitUrl(gitUrl: \$gitUrl) {
    %s
  }
}
QUERY;

    $called = $this->callMethod(FindByGit::class, 'query');
    $this->assertEquals($query, $called);
  }
}
