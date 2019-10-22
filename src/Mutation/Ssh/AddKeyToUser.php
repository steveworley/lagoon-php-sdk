<?php

namespace Lagoon\Mutation\Ssh;

use Lagoon\LagoonQueryBase;

/**
 * Add a project using the graphql api.
 */
class AddKeyToUser extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys(array $variables = []) {
    return [
      'name',
      'keyType',
      'keyValue',
      'email',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
mutation AddKeyToUser(
  \$name: String!
  \$keyValue: String!
  \$keyType: SshKeyType!
  \$email: String!
) {
  addSshKey(input: {
    name: \$name,
    keyType: \$keyType,
    keyValue: \$keyValue,
    user : {
      email: \$email
    }
  } ) {
    %s
  }
}
QUERY;
  }
}
