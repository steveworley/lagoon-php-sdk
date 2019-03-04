<?php

namespace Lagoon\Operation;

use Lagoon\Operation\LagoonOperationBase;
use Lagoon\Mutation\Project\Add;
use Lagoon\Mutation\Project\Update;
use Lagoon\Query\Project\FetchAll;
use Lagoon\Query\Project\FindByName;
use Lagoon\Query\Project\FindByGit;

/**
 * All graphql project operations.
 */
class Project extends LagoonOperationBase {

  /**
   * Naming constants to use throughout the class.
   */
  const ADD_PROJECT = 'add';
  const UPDATE_PROJECT = 'update';
  const FETCH_BY_NAME = 'name';
  const FETCH_ALL = 'all';
  const FETCH_BY_GIT = 'git';

  /**
   * {@inheritdoc}
   */
  protected function bind() {
    $this
      ->addMutation(self::ADD_PROJECT, Add::class)
      ->addMutation(self::UPDATE_PROJECT, Update::class)
      ->addQuery(self::FETCH_BY_NAME, FindByName::class)
      ->addQuery(self::FETCH_ALL, FetchAll::class)
      ->addQuery(self::FETCH_BY_GIT, FindByGit::class);
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
    return $this->mutation(SELF:: ADD_PROJECT, $variables);
  }

  /**
   * Execute the update project mutation.
   *
   * @param array $variables
   *   A list of variables to update.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function update(array $variables = []) {
    return $this->mutation(SELF::UPDATE_PROJECT, $variables);
  }

  /**
   * Fetch a project form the API.
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

  /**
   * Find a project by the git url.
   *
   * @param string $gitUrl
   *   The git url.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function withGit($gitUrl) {
    return $this->query(SELF::FETCH_BY_GIT, ['gitUrl' => $gitUrl]);
  }

  /**
   * Fetch all projects from the API.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function all() {
    return $this->query(SELF::FETCH_ALL);
  }
}
