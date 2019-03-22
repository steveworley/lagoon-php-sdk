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
      'userId',
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
  \$userId: Int!
) {
  addSshKey(input: {
    name: \$name,
    keyType: \$keyType,
    keyValue: \$keyValue,
    userId: \$userId,
  } ) {
    %s
  }
}
QUERY;
  }
}
