<?php

namespace Lagoon\Mutation;

/**
 * Update a project using the grpahql api.
 */
class UpdateProject extends LagoonMutationBase {

  /**
   * {@inheritdoc}
   */
  protected function validate(array $variables = []) {
    $expected_keys = [
      'id',
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
