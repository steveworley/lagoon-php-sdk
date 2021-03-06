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
mutation AddNotificationSlack(
  \$name: String!
  \$channel: String!
  \$webhook: String!
) {
  addNotificationSlack(input: {
    name: \$name,
    channel: \$channel,
    webhook: \$webhook,
  } ) {
    %s
  }
}
QUERY;
  }
}
