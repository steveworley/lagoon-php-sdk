<?php

namespace Lagoon\Test;

use PHPUnit\Framework\TestCase;
use Lagoon\LagoonQueryBase;
use Lagoon\LagoonClient;

class LagoonQueryBaseTest extends TestCase {

  public function provideQueries() {
    $q1 = <<<'QUERY'
query findAll {
  allCustomers {
    %s
  }
}
QUERY;
    $q1_expected = <<<'QUERY'
query findAll {
  allCustomers {
    id
  }
}
QUERY;
    $q2 = <<<'QUERY'
query findAll {
  allCustomers {
    %s
  }
}
QUERY;
    $q2_expected = <<<'QUERY'
query findAll {
  allCustomers {
    id,name
  }
}
QUERY;
    return [
      [['id'], $q1, $q1_expected],
      [['id', 'name'], $q2, $q2_expected],
    ];
  }

  public function setup() {
    $client = $this->getMockBuilder(LagoonClient::class)
      ->disableOriginalConstructor()
      ->getMock();

    $this->client = $client;
  }

  /**
   * Test Validate Fail.
   */
  public function testValidateFail() {
    $pass = false;

    $stub = $this->getMockForAbstractClass(
      LagoonQueryBase::class,
      [$this->client]
    );

    $stub->expects($this->once())
      ->method('expectedKeys')
      ->willReturn(['test']);

    try {
      $stub->validate();
    } catch (\Exception $e) {
      $pass = true;
    }

    $this->assertTrue($pass);
  }

  /**
   * Ensure that the fields added update in the query.
   *
   * @dataProvider provideQueries
   */
  public function testReplaceFields($fields, $template, $expected) {
    $client = $this->client;

    $stub = $this-> getMockForAbstractClass(
      LagoonQueryBase::class,
      [$client]
    );

    $stub->expects($this->once())
      ->method('query')
      ->willReturn($template);

    $stub->fields($fields);
    $this->assertEquals($expected, $stub->getQuery());
  }

}
