<?php

namespace Lagoon\Test\Mutation\User;

use PHPUnit\Framework\TestCase;
use Lagoon\Mutation\Ssh\AddKeyToUser;
use Lagoon\LagoonClient;

class AddKeyToUserTest extends TestCase {

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
    $expected_keys = $this->callMethod(AddKeyToUser::class, 'expectedKeys');
    $this->assertEquals([
      'name',
      'keyType',
      'keyValue',
      'email',
    ], $expected_keys);
  }

  public function testQuery() {
    $query = <<<QUERY
mutation AddKeyToUser(
  \$name: String!
  \$keyValue: String!
  \$keyType: SshKeyType!
  \$email: String!
) {
  addSshKey(input: {
    name: \$name,
    keyType: \$keyType,
    keyValue: \$keyValue,
    user : {
      email: \$email
    }
  } ) {
    %s
  }
}
QUERY;

    $called = $this->callMethod(AddKeyToUser::class, 'query');
    $this->assertEquals($query, $called);
  }
}
