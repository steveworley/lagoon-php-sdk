<?php

namespace Lagoon\Test\Mutation\Notification;

use PHPUnit\Framework\TestCase;
use Lagoon\Mutation\Notification\AddToProject;
use Lagoon\LagoonClient;

class AddToProjectTest extends TestCase {

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
    $expected_keys = $this->callMethod(AddToProject::class, 'expectedKeys');
    $this->assertEquals([
      'notificationType',
      'project',
      'notificationName',
    ], $expected_keys);
  }

  public function testQuery() {
    $query = <<<QUERY
mutation AddSlackNotification(
  \$notificationType: String!
  \$project: String!
  \$notificationName: String!
) {
  addNotificationSlack(
    input: {
      name: \$notificationType
      channel: \$project
      webhook: \$notificationName
    }
  ) {
    %s
  }
}
QUERY;

    $called = $this->callMethod(AddToProject::class, 'query');
    $this->assertEquals($query, $called);
  }
}
