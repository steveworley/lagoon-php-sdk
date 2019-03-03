<?php

namespace Lagoon\Operation;

use Lagoon\Operation\LagoonOperationBase;
use Lagoon\Mutation\Customer\Add;
use Lagoon\Query\Customer\FetchAll;
use Lagoon\LagoonResult;

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
      ->addMutation(self::ADD, new Add($this->client))
      ->addQuery(self::FETCH_ALL, new FetchAll($this->client));
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
    $result = $this->mutation(self::ADD)->execute($variables);
    return LagoonResult::fromJSON($result);
  }

  /**
   * Fetch all projects from the API.
   *
   * @return Lagoon\LagoonResult
   *   The lagoon result object.
   */
  public function all() {
    $result = $this->query(self::FETCH_ALL)->execute([]);
    return LagoonResult::fromJSON($result);
  }
}
