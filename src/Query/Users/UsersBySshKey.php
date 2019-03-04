<?php

namespace Lagoon\Query\Users;

use Lagoon\LagoonQueryBase;

/**
 * Update a project using the grpahql api.
 */
class UsersBySshKey extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys() {
    return ['sshKey'];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
query FindByKey(\$sshKey: String!) {
  userBySshKey(sshKey: \$sshKey) {
    %s
  }
}
QUERY;
  }
}
