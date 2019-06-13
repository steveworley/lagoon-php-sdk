<?php

namespace Lagoon\Mutation\Environment;

use Lagoon\LagoonQueryBase;

/**
 * Update a project.
 */
class Update extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys(array $variables = []) {
    return [
      'id',
      'patch',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
mutation UpdateEnvironment(
  \$id: Int!
  \$patch: UpdateEnvironmentPatchInput!
) {
  updateEnvironment(input: {
    id: \$id
    patch: \$patch
  }) {
    %s
  }
}
QUERY;
  }

}
