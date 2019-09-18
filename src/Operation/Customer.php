<?php

namespace Lagoon\Operation;

use Lagoon\Operation\LagoonOperationBase;

/**
 * Customer graphql operations.
 */
class Customer extends LagoonOperationBase {

  /**
   * {@inheritdoc}
   */
  protected function bind() {}

  /**
   * Execute the add project mutation.
   *
   * @param array $variables
   *   A list of variables to add.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function add(array $variables = []) {
    throw new \Exception('customer->add() is deprecated and will be removed.');
  }

  /**
   * Fetch all projects from the API.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function all() {
    throw new \Exception('customer->all() is deprecated and will be removed.');
  }

  /**
   * Fetch a customer form the API.
   *
   * @param string $variables
   *   The name of a project.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function withName($name) {
    throw new \Exception('customer->withName() is deprecated and will be removed.');
  }
}
