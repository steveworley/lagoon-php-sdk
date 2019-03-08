<?php

namespace Lagoon\Test\Mutation\Environment;

use PHPUnit\Framework\TestCase;
use Lagoon\Mutation\Environment\AddVariable;
use Lagoon\LagoonClient;

class AddVariableTest extends TestCase {

  protected $client;

  public function callMethod($obj, $name, array $args = [])
  {
    $class = new \ReflectionClass($obj);
    $method = $class->getMethod($name);
    $method->setAccessible(true);
    return $method->invokeArgs(new $obj($this->client), $args);
  }

  public function setup()
  {
    $client = $this->getMockBuilder(LagoonClient::class)
      ->disableOriginalConstructor()
      ->getMock();

    $this->client = $client;
  }

  public function testExpectedKeys()
  {
    $expected_keys = $this->callMethod(AddVariable::class, 'expectedKeys');
    $this->assertEquals([
      'type',
      'typeId',
      'scope',
      'name',
      'value',
    ], $expected_keys);
  }

  public function testQuery()
  {
    $query = <<<QUERY
mutation AddEnvironmentVar(
  \$type: String!
  \$typeId: Int!
  \$scope: String!
  \$name: String!
  \$value: String!
) {
  addEnvVariable(input: {
    type: \$type,
    typeId: \$typeId,
    scope: \$scope,
    name: \$name,
    value: \$value,
  } ) {
    %s
  }
}
QUERY;

    $called = $this->callMethod(AddVariable::class, 'query');
    $this->assertEquals($query, $called);
  }
}
