<?php

namespace Lagoon\Mutation\Project;

use Lagoon\LagoonQueryBase;

/**
 * Deploy a project branch via GraphQL.
 */
class DeployBranch extends LagoonQueryBase {

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
mutation DeployProjectBranchMutation(
  \$projectName: String!
  \$projectBranch: String!
) {
  deployEnvironmentBranch(
    input: {
      project: {
        name: \$projectName
      }
      branchName: \$projectBranch
    }
  )
}
QUERY;
  }
}
