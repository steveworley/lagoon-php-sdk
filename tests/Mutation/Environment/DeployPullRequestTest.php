<?php

namespace Lagoon\Test\Mutation\Environment;

use PHPUnit\Framework\TestCase;
use Lagoon\Mutation\Environment\DeployPullRequest;
use Lagoon\LagoonClient;

class DeployPullRequestTest extends TestCase
{

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
    $expected_keys = $this->callMethod(DeployPullRequest::class, 'expectedKeys');
    $this->assertEquals([
      'name',
      'number',
      'title',
      'headBranchName',
      'headBranchRef',
      'baseBranchName',
      'baseBranchRef',
    ], $expected_keys);
  }

  public function testQuery()
  {
    $query = <<<QUERY
mutation DeployPullRequest(
  \$name: String!
  \$number: Int!
  \$title: String!
  \$headBranchName: String!
  \$headBranchRef: String!
  \$baseBranchName: String!
  \$baseBranchRef: String!
) {
  deployEnvironmentPullrequest(input: {
    project: {
      name: \$name
    }
    number: \$number
    title: \$title
    headBranchName: \$headBranchName
    headBranchRef: \$headBranchRef
    baseBranchRef: \$baseBranchRef
    baseBranchName: \$baseBranchName
  })
}
QUERY;

    $called = $this->callMethod(DeployPullRequest::class, 'query');
    $this->assertEquals($query, $called);
  }
}
