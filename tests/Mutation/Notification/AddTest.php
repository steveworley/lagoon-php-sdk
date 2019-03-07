<?php

namespace Lagoon\Test\Mutation\Notification;

use PHPUnit\Framework\TestCase;
use Lagoon\Mutation\Notification\Add;
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

  public function testExpectedKeys() {
    $expected_keys = $this->callMethod(Add::class, 'expectedKeys');
    $this->assertEquals([
      'name',
      'channel',
      'webhook',
    ], $expected_keys);
  }

  public function testQuery() {
    $query = <<<QUERY
mutation AddNotification(
  \$name: String!
  \$channel: String!
  \$webhook: String!
) {
  addProject(input: {
    name: \$name,
    channel: \$channel,
    webhook: \$webhook,
  } ) {
    %s
  }
}
QUERY;

    $called = $this->callMethod(Add::class, 'query');
    $this->assertEquals($query, $called);
  }
}
