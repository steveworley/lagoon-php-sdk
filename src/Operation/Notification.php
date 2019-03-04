<?php

namespace Lagoon\Operation;

use Lagoon\Operation\LagoonOperationBase;
use Lagoon\Mutation\Notification\AddSlack;

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
    $this->addMutation(self::ADD_SLACK, AddSlack::class);
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
    return $this->mutation(SELF::ADD_PROJECT, $variables);
  }
}
