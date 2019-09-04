<?php

namespace Lagoon\Test\Mutation\Environment;

use PHPUnit\Framework\TestCase;
use Lagoon\Mutation\Environment\DeleteVariable;
use Lagoon\LagoonClient;

class DeleteVariableTest extends TestCase {

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
    $expected_keys = $this->callMethod(DeleteVariable::class, 'expectedKeys');
    $this->assertEquals([
      'id',
    ], $expected_keys);
  }

  public function testQuery() {
    $query = <<<QUERY
mutation DeleteEnvVar(
  \$id: Int!
) {
  deleteEnvVariable(input: {
    id: \$id
  })
}
QUERY;

    $called = $this->callMethod(DeleteVariable::class, 'query');
    $this->assertEquals($query, $called);
  }
}
