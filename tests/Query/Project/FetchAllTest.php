<?php

namespace Lagoon\Test\Query\Project;

use PHPUnit\Framework\TestCase;
use Lagoon\Query\Project\FetchAll;
use Lagoon\LagoonClient;

/**
 * Test the fetch all query.
 */
class FetchAllTest extends TestCase {

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
    $expected_keys = $this->callMethod(FetchAll::class, 'expectedKeys');
    $this->assertEquals([], $expected_keys);
  }

  /**
   * Test that the query matche what is expected.
   */
  public function testQuery() {
    $query = <<<'QUERY'
query findAll {
  allProjects {
    %s
  }
}
QUERY;

    $called = $this->callMethod(FetchAll::class, 'query');
    $this->assertEquals($query, $called);
  }
}
