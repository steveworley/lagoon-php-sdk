<?php

namespace Lagoon\Test\Mutation\Project;

use PHPUnit\Framework\TestCase;
use Lagoon\Mutation\Notification\AddSlack;
use Lagoon\LagoonClient;

class AddSlackTest extends TestCase {

  /**
   * The client instance.
   */
  protected $client;

  /**
   * Reflection for calling a private method.
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
   * Test the expected keys.
   */
  public function testExpectedKeys() {
    $expected_keys = $this->callMethod(AddSlack::class, 'expectedKeys');
    $this->assertEquals([
      'name',
      'channel',
      'webhook',
    ], $expected_keys);
  }

  /**
   * Test the expected query.
   */
  public function testQuery() {
    $query = <<<QUERY
mutation AddSlackNotification(
  \$name: String!
  \$channel: String!
  \$webhook: String!
) {
  addNotificationSlack(
    input: {
      name: \$name
      channel: \$channel
      webhook: \$webhook
    }
  ) {
    %s
  }
}
QUERY;

    $called = $this->callMethod(AddSlack::class, 'query');
    $this->assertEquals($query, $called);
  }
}
