<?php

namespace Lagoon\Mutation;

/**
 * Add a project using the graphql api.
 */
class AddProject extends LagoonMutationBase {

  /**
   * {@inheritdoc}
   */
  protected function validate(array $variables = []) {
    $expected_keys = [
      'name',
      'customer',
      'openshift',
      'gitUrl',
      'productionEnvironment',
      'branches'
    ];
    $missing = array_diff($expected_keys, array_keys($variables));
    assert(count($missing) === 0, "Keys [" . implode(', ', $missing) . "] missing. Cannot add project.");
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
