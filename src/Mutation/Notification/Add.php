<?php

namespace Lagoon\Mutation\Notification;

use Lagoon\LagoonQueryBase;

/**
 * Add a slack notification to a project using the graphql api.
 */
class Add extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys() {
    return [
      'name',
      'channel',
      'webhook',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
mutation AddNewProject(
  \$name: String!
  \$customer: Int!
  \$openshift: Int!
  \$gitUrl: String!
  \$productionEnvironment: String!
  \$branches: String!
) {
  addProject(input: {
    name: \$name,
    customer: \$customer,
    openshift: \$openshift,
    gitUrl: \$gitUrl,
    productionEnvironment: \$productionEnvironment,
    branches: \$branches
  } ) {
    %s
  }
}
QUERY;
  }
}
