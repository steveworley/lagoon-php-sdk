<?php

namespace Lagoon\Mutation\User;

use Lagoon\LagoonQueryBase;

/**
 * Add a project using the graphql api.
 */
class Add extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys(array $variables = []) {
    return [
      'email',
      'firstName',
      'lastName',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
mutation AddNewUser(
  \$email: String!
  \$firstName: String!
  \$lastName: String!
) {
  addUser(input: {
    email: \$email,
    firstName: \$firstName,
    lastName: \$lastName,
  } ) {
    %s
  }
}
QUERY;
  }
}
