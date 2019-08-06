<?php

namespace Lagoon\Mutation\Project;

use Lagoon\LagoonQueryBase;

/**
 * Deploy a project branch via GraphQL.
 */
class DeployEnvironmentLatest extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys() {
    return [
      'projectName',
      'projectBranch',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
mutation DeployEnvironmentLatestMutation(
  \$projectName: String!
  \$projectBranch: String!
) {
  deployEnvironmentLatest(input: {
    environment: {
      project: {
        name: \$projectName
      }
      name: \$projectBranch
    }
  })
}
QUERY;
  }
}
