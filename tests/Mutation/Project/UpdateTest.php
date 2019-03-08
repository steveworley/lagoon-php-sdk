<?php

namespace Lagoon\Test\Mutation\Project;

use PHPUnit\Framework\TestCase;
use Lagoon\Mutation\Project\Update;
use Lagoon\LagoonClient;

/**
 * Test the update mutation.
 */
class UpdateTest extends TestCase {

  /**
   * Mocked client.
   *
   * @var Lagoon\LagoonClientInterface
   */
  protected $client;

  /**
   * Reflection method call.
   *
   * Change protected methods so we can test them.
   */
  public function callMethod($obj, $name, array $args = []) {
    $class = new \ReflectionClass($obj);
    $method = $class->getMethod($name);
    $method->setAccessible(true);
    return $method->invokeArgs(new $obj($this->client), $args);
  }

  /**
   * Setup method.
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
    $expected_keys = $this->callMethod(Update::class, 'expectedKeys');
    $this->assertEquals([
      'id',
      'name',
      'customer',
      'openshift',
      'gitUrl',
      'productionEnvironment',
      'branches',
    ], $expected_keys);
  }

  /**
   * Test the expected query.
   */
  public function testQuery() {
    $query = <<<QUERY
mutation UpdateProjectMutation(
  \$id: Int!
  \$name: String!
  \$customer: Int!
  \$openshift: Int!
  \$gitUrl: String!
  \$productionEnvironment: String!
  \$branches: String!
) {
  updateProject(
    input: {
      id: \$id,
      patch: {
        name: \$name,
        customer: \$customer,
        openshift: \$openshift,
        gitUrl: \$gitUrl,
        productionEnvironment: \$productionEnvironment,
        branches: \$branches
      }
    }
  ) {
    %s
  }
}
QUERY;

    $called = $this->callMethod(Update::class, 'query');
    $this->assertEquals($query, $called);
  }
}
