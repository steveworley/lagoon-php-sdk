<?php

namespace Lagoon\Mutation\Notification;

use Lagoon\LagoonQueryBase;

/**
 * Add a notification to a project.
 */
class AddToProject extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys()
  {
    return [
      'notificationType',
      'project',
      'notificationName',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function query()
  {
    return <<<QUERY
mutation AddSlackNotification(
  \$notificationType: String!
  \$project: String!
  \$notificationName: String!
) {
  addNotificationSlack(
    input: {
      name: \$notificationType
      channel: \$project
      webhook: \$notificationName
    }
  ) {
    %s
  }
}
QUERY;
  }
}
