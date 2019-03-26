<?php

namespace Lagoon\Test\Mutation\Environment;

use PHPUnit\Framework\TestCase;
use Lagoon\Mutation\Environment\Delete;
use Lagoon\LagoonClient;

class DeleteTest extends TestCase {

  protected $client;

  public function callMethod($obj, $name, array $args = []) {
    $class = new \ReflectionClass($obj);
    $method = $class->getMethod($name);
    $method->setAccessible(true);
    return $method->invokeArgs(new $obj($this->client), $args);
  }

  public function setup() {
    $client = $this->getMockBuilder(LagoonClient::class)
      ->disableOriginalConstructor()
      ->getMock();

    $this->client = $client;
  }

  public function testExpectedKeys() {
    $expected_keys = $this->callMethod(Delete::class, 'expectedKeys');
    $this->assertEquals([
      'name',
      'project',
      'execute',
    ], $expected_keys);
  }

  public function testQuery() {
    $query = <<<QUERY
mutation DeleteEnv(
  \$name: String!
  \$project: String!
  \$execute: Boolean
) {
  deleteEnvironment(input: {
    name: \$name
    project: \$project
    execute: \$execute
  })
}
QUERY;

    $called = $this->callMethod(Delete::class, 'query');
    $this->assertEquals($query, $called);
  }
}
