<?php

namespace Lagoon\Mutation\Project;

use Lagoon\Mutation\LagoonMutationBase;

/**
 * Add a project using the graphql api.
 */
class Add extends LagoonMutationBase {

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
