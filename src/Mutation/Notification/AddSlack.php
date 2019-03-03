<?php

namespace Lagoon\Mutation\Project;

use Lagoon\Mutation\LagoonMutationBase;

/**
 * Add a slack notification to a project using the graphql api.
 */
class Add extends LagoonMutationBase {

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
mutation {
  addNotificationSlack(
    input: {
      \$name: String!,
      \$channel: String!,
      \$webbhook: String!,
    }
  ) {
    id
  }
}
QUERY;
  }
}
