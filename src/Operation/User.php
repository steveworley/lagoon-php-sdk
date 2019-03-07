<?php

namespace Lagoon\Operation;

use Lagoon\Operation\LagoonOperationBase;
use Lagoon\Query\Users\UsersBySshKey;

/**
 * Notification graphql operations.
 */
class User extends LagoonOperationBase {

  /**
   * Naming constants to use throughout the class.
   */
  const SSH_KEY = 'find_ssh_key';

  /**
   * {@inheritdoc}
   */
  protected function bind() {
    $this->addQuery(self::SSH_KEY, UsersBySshKey::class);
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
    return $this->query(SELF::UsersBySshKey, ['sshKey' => $key]);
  }
}
