<?php

namespace Lagoon\Mutation\Project;

use Lagoon\Mutation\LagoonMutationBase;

/**
 * Update a project using the grpahql api.
 */
class Update extends LagoonMutationBase {

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
      'branches'
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
    name
    customer {
      name
    }
    openshift {
      name
    }
    gitUrl,
    activeSystemsDeploy,
    activeSystemsRemove,
    branches,
    pullrequests
  }
}
QUERY;
  }
}
