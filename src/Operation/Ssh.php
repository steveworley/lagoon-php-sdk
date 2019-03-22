<?php

namespace Lagoon\Operation;

use Lagoon\Operation\LagoonOperationBase;
use Lagoon\Mutation\Ssh\AddKeyToUser;

/**
 * Notification graphql operations.
 */
class Ssh extends LagoonOperationBase {

  /**
   * Naming constants to use throughout the class.
   */
  const ADD_KEY_TO_USER = 'add_to_user';

  /**
   * {@inheritdoc}
   */
  protected function bind() {
    $this->addMutation(self::ADD_KEY_TO_USER, AddKeyToUser::class);
  }

  /**
   * Execute the add to project mutation.
   *
   * @param string $key
   *   The public key to add.
   * @param int $user_id
   *   The user to add.
   * @param string $type
   *   The type of key.
   * @param string $name
   *   The name of the key.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function addToUser($key, $user_id, $type = 'SSH_RSA', $name = 'sdk') {
    return $this->mutation(self::ADD_KEY_TO_USER, [
      'name' => $name,
      'keyType' => $type,
      'keyValue' => $key,
      'userId' => $user_id,
    ]);
  }
}
