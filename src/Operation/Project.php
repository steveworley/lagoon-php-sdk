<?php

namespace Lagoon\Operation;

use Lagoon\Operation\LagoonOperationBase;
use Lagoon\Mutation\Project\Add;
use Lagoon\Mutation\Project\Update;
use Lagoon\Query\Project\FetchAll;
use Lagoon\Query\Project\FindByName;
use Lagoon\LagoonResult;

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
      ->addMutation(self::ADD_PROJECT, new Add($this->client))
      ->addMutation(self::UPDATE_PROJECT, new Update($this->client))
      ->addQuery(self::FETCH_BY_NAME, new FindByName($this->client))
      ->addQuery(self::FETCH_ALL, new FetchAll($this->client))
      ->addQuert(self::FETCH_BY_GIT, new FetchByGit($this->client));
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
    $result = $this->mutation(self::ADD_PROJECT)->execute($variables);
    return LagoonResult::fromJSON($result);
  }

  /**
   * Execute the update project mutation.
   *
   * @param array $variables
   *   A list of variables to update.
   *
   * @return Lagoon\LagoonResult
   *   The lagoon result object.
   */
  public function update($variables) {
    $result = $this->mutations(self::UPDATE_PROJECT)->execute($variables);
    return LagoonResult::fromJSON($result);
  }

  /**
   * Fetch a project form the API.
   *
   * @param array $variables
   *   A list of variables to update.
   *
   * @return Lagoon\LagoonResult
   *   The lagoon result object.
   */
  public function fetch($variables) {
    $result = $this->query(self::FETCH_BY_NAME)->execute($variables);
    return LagoonResult::fromJSON($result);
  }

  /**
   * Find a project by the git url.
   *
   * @params string $gitUrl
   *   The git url.
   *
   * @return Lagoon\LagoonResult
   *   The lagoon result object.
   */
  public function withGit($gitUrl) {
    $result = $this->query(self::FETCH_BY_GIT)->exect(['gitUrl' => $gitUrl]);
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
