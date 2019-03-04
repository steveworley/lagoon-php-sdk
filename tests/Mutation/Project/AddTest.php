<?php

namespace Lagoon\Test\Mutation\Project;

use PHPUnit\Framework\TestCase;
use Lagoon\Mutation\Project\Add;
use Lagoon\LagoonClient;

class AddTest extends TestCase {

  protected $client;

  public function callMethod($obj, $name, array $args = []) {
    $class = new \ReflectionClass($obj);
    $method = $class->getMethod($name);
    $method->setAccessible(TRUE);
    return $method->invokeArgs(new $obj($this->client), $args);
  }

  public function setup() {
    $client = $this->getMockBuilder(LagoonClient::class)
      ->disableOriginalConstructor()
      ->getMock();

    $this->client = $client;
  }

  public function testExpectedKeys() {
    $expected_keys = $this->callMethod(Add::class, 'expectedKeys');
    $this->assertEquals([
      'name',
      'customer',
      'openshift',
      'gitUrl',
      'productionEnvironment',
      'branches',
    ], $expected_keys);
  }

  public function testQuery() {
    $query = <<<QUERY
mutation AddNewProject(
  \$name: String!
  \$customer: String!
  \$opneshift: String!
  \$productionEnvironment: String!
  \$branches: String!
) {
  addProject(input: {
    name: \$name,
    customer: \$customer,
    openshift: \$openshift,
    productionEnvironment: \$productionEnvironment,
    branches: \$branches
  } ) {
    %s
  }
}
QUERY;

    $called = $this->callMethod(Add::class, 'query');
    $this->assertEquals($query, $called);
  }

}
