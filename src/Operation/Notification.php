<?php

namespace Lagoon\Operation;

use Lagoon\Operation\LagoonOperationBase;
use Lagoon\Mutation\Notification\AddSlack;
use Lagoon\LagoonResult;

/**
 * Notification graphql operations.
 */
class Notification extends LagoonOperationBase {

  /**
   * Naming constants to use throughout the class.
   */
  const ADD_SLACK = 'add_slack';

  /**
   * {@inheritdoc}
   */
  protected function bind() {
    $this->addMutation(self::ADD_SLACK, new AddSlack($this->client));
  }

  /**
   * Execute the add slack mutation.
   *
   * @param array $variables
   *   A list of variables to add.
   *
   * @return Lagoon\LagoonResult
   *   The lagoon result object.
   */
  public function addSlack(array $variables = []) {
    $result = $this->mutation(self::ADD_SLACK)->execute($variables);
    return LagoonResult::fromJSON($result);
  }
}
