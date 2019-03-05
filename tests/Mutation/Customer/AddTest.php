<?php

namespace Lagoon\Test\Mutation\Customer;

use PHPUnit\Framework\TestCase;
use Lagoon\Mutation\Customer\Add;
use Lagoon\LagoonClient;

class AddTest extends TestCase {

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

  /**
   * Test the expected keys.
   */
  public function testExpectedKeys() {
    $expected_keys = $this->callMethod(Add::class, 'expectedKeys');
    $this->assertEquals([
      'name',
      'privateKey',
    ], $expected_keys);
  }

  /**
   * Test the expected query.
   */
  public function testQuery() {
    $query = <<<QUERY
mutation AddCustomer(\$name: String!, \$privateKey: String!) {
  addCustomer(
    input: {
      name: \$name
      privateKey: \$privateKey
    }
  ) {
    %s
  }
}
QUERY;

    $called = $this->callMethod(Add::class, 'query');
    $this->assertEquals($query, $called);
  }
}
