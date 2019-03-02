<?php

namespace Lagoon\Operation;

use Lagoon\Mutation\AddProject;
use Lagoon\LagoonClientInterface;
use Lagoon\Query\Project\FetchAll;
use Lagoon\Query\Project\FindByName;

class Project extends LagoonOperationBase {

  /**
   * Naming constants to use throughout the class.
   */
  const ADD_PROJECT = 'add';
  const UPDATE_PROJECT = 'update';
  const FETCH_BY_NAME = 'name';
  const FETCH_ALL = 'all';

  /**
   * {@inheritdoc}
   */
  protected function bind() {
    $this
      ->addMutation(self::ADD_PROJECT, new AddProject($this->client))
      ->addMutation(self::UPDATE_PROJECT, new AddProject($this->client))
      ->addQuery(self::FETCH_BY_NAME, new FindByName($this->client))
      ->addQuery(self::FETCH_ALL, new FetchAll($this->client));
  }

  /**
   * Execute the add project mutation.
   *
   * @param array $variables
   *   A list of variables to add.
   *
   * @return mixed
   */
  public function add(array $variables = []) {
    return $this->mutation(self::ADD_PROJECT)->execute($variables);
  }

  /**
   * Execute the update project mutation.
   *
   * @param array $variables
   *   A list of variables to update.
   *
   * @return mixed
   */
  public function update($variables) {
    return $this->mutations(self::UPDATE_PROJECT)->execute($variables);
  }

  /**
   * Fetch a project form the API.
   *
   * @param array $variables
   *   A list of variables to update.
   *
   * @return mixed
   */
  public function fetch($variables) {
    return $this->query(self::FETCH_BY_NAME)->execute($variables);
  }

  public function all() {
    return $this->query(self::FETCH_ALL)->execute([]);
  }
}
