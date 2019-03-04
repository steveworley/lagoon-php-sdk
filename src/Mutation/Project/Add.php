<?php

namespace Lagoon\Mutation\Project;

use Lagoon\LagoonQueryBase;

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
mutation AddNewProject(
  \$name: String!
  \$customer: String!
  \$opneshift: String!
  \$productionEnvironment: String!
  \$branches: String!
) {
  addProject(input: {
    name: \$name,
    customer: \$customer,
    openshift: \$openshift,
    productionEnvironment: \$productionEnvironment,
    branches: \$branches
  } ) {
    %s
  }
}
QUERY;
  }
}
