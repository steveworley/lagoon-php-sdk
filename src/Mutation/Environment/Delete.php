<?php

namespace Lagoon\Mutation\Environment;

use Lagoon\LagoonQueryBase;

/**
 * Add a project using the graphql api.
 */
class Delete extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys(array $variables = []) {
    return [
      'name',
      'project',
      'execute',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
mutation DeleteEnv(
  \$name: String!
  \$project: String!
  \$execute: Boolean
) {
  deleteEnvironment(input: {
    name: \$name
    project: \$project
    execute: \$execute
  })
}
QUERY;
  }
}
