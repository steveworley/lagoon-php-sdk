<?php

namespace Lagoon\Mutation\Environment;

use Lagoon\LagoonQueryBase;

/**
 * Add a project using the graphql api.
 */
class DeployPullRequest extends LagoonQueryBase
{

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys(array $variables = [])
  {
    return [
      'name',
      'number',
      'title',
      'headBranchName',
      'headBranchRef',
      'baseBranchName',
      'baseBranchRef',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function query()
  {
    return <<<QUERY
mutation DeployPullRequest(
  \$name: String!
  \$number: Int!
  \$title: String!
  \$headBranchName: String!
  \$headBranchRef: String!
  \$baseBranchName: String!
  \$baseBranchRef: String!
) {
  deployEnvironmentPullrequest(input: {
    project: {
      name: \$name
    }
    number: \$number
    title: \$title
    headBranchName: \$headBranchName
    headBranchRef: \$headBranchRef
    baseBranchRef: \$baseBranchRef
    baseBranchName: \$baseBranchName
  })
}
QUERY;
  }
}
