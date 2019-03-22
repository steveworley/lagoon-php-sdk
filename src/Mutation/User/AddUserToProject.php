<?php

namespace Lagoon\Mutation\User;

use Lagoon\LagoonQueryBase;

/**
 * Add a project using the graphql api.
 */
class AddUserToProject extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys(array $variables = []) {
    return [
      'project',
      'userId',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
mutation AddUserToProject(
  \$project: String!
  \$userId: Int!
) {
  addUserToProject(input: {
    project: \$project,
    userId: \$userId,
  } ) {
    %s
  }
}
QUERY;
  }
}
