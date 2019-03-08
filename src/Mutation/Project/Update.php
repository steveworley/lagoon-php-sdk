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
mutation UpdateProjectMutation(
  \$id: Int!
  \$name: String!
  \$customer: Int!
  \$openshift: Int!
  \$gitUrl: String!
  \$productionEnvironment: String!
  \$branches: String!
) {
  updateProject(
    input: {
      id: \$id,
      patch: {
        name: \$name,
        customer: \$customer,
        openshift: \$openshift,
        gitUrl: \$gitUrl,
        productionEnvironment: \$productionEnvironment,
        branches: \$branches
      }
    }
  ) {
    %s
  }
}
QUERY;
  }
}
