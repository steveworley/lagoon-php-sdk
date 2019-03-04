<?php

namespace Lagoon\Mutation\Project;

use Lagoon\LagoonQueryBase;

/**
 * Update a project using the grpahql api.
 */
class Update extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys() {
    return [
      'id',
      'name',
      'customer',
      'openshift',
      'gitUrl',
      'productionEnvironment',
      'branches',
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
      \$id: Int,
      patch: {
        \$name: String!,
        \$customer: String!,
        \$openshift: String!,
        \$gitUrl: String!,
        \$productionEnvironment: String!,
        \$branches: String!
      }
    }
  ) {
    %s
  }
}
QUERY;
  }
}
