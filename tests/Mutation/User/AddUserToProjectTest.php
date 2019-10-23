<?php

namespace Lagoon\Test\Mutation\User;

use PHPUnit\Framework\TestCase;
use Lagoon\Mutation\User\AddUserToProject;
use Lagoon\LagoonClient;

class AddUserToProjectTest extends TestCase {

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
    $expected_keys = $this->callMethod(AddUserToProject::class, 'expectedKeys');
    $this->assertEquals([
      'group',
      'email',
    ], $expected_keys);
  }

  public function testQuery() {
    $query = <<<QUERY
mutation AddUserToProject(
  \$group: String!
  \$email: String!
) {
  addUserToGroup (input: {
    user: {
      email: \$email
    }
    group: {
      name: \$group
    }
    role: MAINTAINER
  }
  ) {
    %s
  }
}
QUERY;

    $called = $this->callMethod(AddUserToProject::class, 'query');
    $this->assertEquals($query, $called);
  }
}
