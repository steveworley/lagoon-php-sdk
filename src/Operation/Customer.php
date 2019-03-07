<?php

namespace Lagoon\Operation;

use Lagoon\Operation\LagoonOperationBase;
use Lagoon\Mutation\Customer\Add;
use Lagoon\Query\Customer\FetchAll;
use Lagoon\Query\Customer\FindByName;

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
      ->addQuery(self::FETCH_ALL, FetchAll::class)
      ->addQuery(self::FETCH_BY_NAME, FindByName::class);
  }

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
    return $this->mutation(self::ADD, $variables);
  }

  /**
   * Fetch all projects from the API.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function all() {
    return $this->query(self::FETCH_ALL);
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
    return $this->query(SELF::FETCH_BY_NAME, ['name' => $name]);
  }
}
