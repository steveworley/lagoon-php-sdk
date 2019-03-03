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
  protected function expectedKeys(array $variables = []) {
    return [
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
      \$name: String!,
      \$customer: String!,
      \$openshift: String!,
      \$gitUrl: String!,
      \$productionEnvironment: String!,
      \$branches: String!
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
