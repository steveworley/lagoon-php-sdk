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
  protected function expectedKeys() {
    return [
      'notificationType',
      'project',
      'notificationName',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
mutation AddNotificationToProject(
  \$notificationType: NotificationType!
  \$project: String!
  \$notificationName: String!
) {
  addNotificationToProject(
    input: {
      notificationType: \$notificationType
      project: \$project
      notificationName: \$notificationName
    }
  ) {
    %s
  }
}
QUERY;
  }
}
