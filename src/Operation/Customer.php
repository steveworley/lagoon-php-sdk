<?php

namespace Lagoon\Operation;

use Lagoon\Operation\LagoonOperationBase;
use Lagoon\Mutation\Customer\Add;
use Lagoon\Query\Customer\FetchAll;

/**
 * Customer graphql operations.
 */
class Customer extends LagoonOperationBase {

  /**
   * Naming constants to use throughout the class.
   */
  const ADD = 'add';
  const UPDATE = 'update';
  const FETCH_BY_NAME = 'name';
  const FETCH_ALL = 'all';

  /**
   * {@inheritdoc}
   */
  protected function bind() {
    $this
      ->addMutation(self::ADD, Add::class)
      ->addQuery(self::FETCH_ALL, FetchAll::class);
  }

  /**
   * Execute the add project mutation.
   *
   * @param array $variables
   *   A list of variables to add.
   *
   * @return Lagoon\LagoonResult
   *   The lagoon result object.
   */
  public function add(array $variables = []) {
    return $this->mutation(self::ADD, $variables);
  }

  /**
   * Fetch all projects from the API.
   *
   * @return Lagoon\LagoonResult
   *   The lagoon result object.
   */
  public function all() {
    return $this->query(self::FETCH_ALL);
  }
}
