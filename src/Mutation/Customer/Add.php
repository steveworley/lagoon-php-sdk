<?php

namespace Lagoon\Mutation\Customer;

use Lagoon\LagoonQueryBase;

/**
 * Add a project using the graphql api.
 */
class Add extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys() {
    return [
      'name',
      'privateKey',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
mutation {
  addProject(
    input: {
      \$name: String!,
      \$privateKey: String!,
    }
  ) {
    name
    id
}
QUERY;
  }
}
