<?php

namespace Lagoon\Operation;

use Lagoon\Operation\LagoonOperationBase;
use Lagoon\Mutation\Notification\AddSlack;
use Lagoon\Mutation\Notification\AddToProject;

/**
 * Notification graphql operations.
 */
class Notification extends LagoonOperationBase {

  /**
   * Naming constants to use throughout the class.
   */
  const ADD_SLACK = 'add_slack';
  const ADD_TO_PROJECT = 'add_to_project';

  /**
   * {@inheritdoc}
   */
  protected function bind() {
    $this->addMutation(self::ADD_SLACK, AddSlack::class)
      ->addMutation(self::ADD_TO_PROJECT, AddToProject::class);
  }

  /**
   * Execute the add slack mutation.
   *
   * @param array $variables
   *   A list of variables to add.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function addSlack(array $variables = []) {
    return $this->mutation(SELF::ADD_SLACK, $variables);
  }

  /**
   * Exceute the add to project mutation.
   *
   * @param array $varibales
   *   A list of variables to add.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function addToProject(array $variables = []) {
    return $this->mutation(SELF::ADD_TO_PROJECT, $variables);
  }
}
