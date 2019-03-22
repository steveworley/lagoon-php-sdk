<?php

namespace Lagoon\Operation;

use Lagoon\Operation\LagoonOperationBase;
use Lagoon\Query\Users\UsersBySshKey;
use Lagoon\Mutation\User\Add;
use Lagoon\Mutation\User\AddUserToProject;

/**
 * Notification graphql operations.
 */
class User extends LagoonOperationBase {

  /**
   * Naming constants to use throughout the class.
   */
  const SSH_KEY = 'find_ssh_key';
  const ADD = 'add';
  const ADD_TO_PROJECT = 'add_to_project';

  /**
   * {@inheritdoc}
   */
  protected function bind() {
    $this->addQuery(self::SSH_KEY, UsersBySshKey::class)
      ->addMutation(self::ADD, Add::class)
      ->addMutation(self::ADD_TO_PROJECT, AddUserToProject::class);
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
  public function withKey($key = '') {
    return $this->query(self::SSH_KEY, ['sshKey' => $key]);
  }

  /**
   * Execute the add to project mutation.
   *
   * @param int $user_id
   *   The user to add.
   * @param string $project
   *   The project to add the user to.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function add(array $variables = []) {
    return $this->mutation(self::ADD, $variables);
  }

  /**
   * Execute the add to project mutation.
   *
   * @param int $user_id
   *   The user to add.
   * @param string $project
   *   The project to add the user to.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function addToProject($user_id, $project = '') {
    return $this->mutation(self::ADD_TO_PROJECT, [
      'userId' => $user_id,
      'project' => $project,
    ]);
  }
}
