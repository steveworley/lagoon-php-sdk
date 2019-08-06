<?php

namespace Lagoon\Test\Mutation\Environment;

use PHPUnit\Framework\TestCase;
use Lagoon\Mutation\Environment\Update;
use Lagoon\LagoonClient;

class UpdateTest extends TestCase {

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
    $expected_keys = $this->callMethod(Update::class, 'expectedKeys');
    $this->assertEquals([
      'id',
      'patch',
    ], $expected_keys);
  }

  public function testQuery() {
    $query =<<<QUERY
mutation UpdateEnvironment(
  \$id: Int!
  \$patch: UpdateEnvironmentPatchInput!
) {
  updateEnvironment(input: {
    id: \$id
    patch: \$patch
  }) {
    %s
  }
}
QUERY;

    $called = $this->callMethod(Update::class, 'query');
    $this->assertEquals($query, $called);
  }

}
