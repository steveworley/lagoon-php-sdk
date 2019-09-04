<?php

namespace Lagoon\Mutation\Environment;

use Lagoon\LagoonQueryBase;

/**
 * Add a project using the graphql api.
 */
class DeleteVariable extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys(array $variables = []) {
    return [
      'id',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
mutation DeleteEnvVar(
  \$id: Int!
) {
  deleteEnvVariable(input: {
    id: \$id
  })
}
QUERY;
  }
}
