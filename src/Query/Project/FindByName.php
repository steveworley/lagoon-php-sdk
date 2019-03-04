<?php

namespace Lagoon\Query\Project;

use Lagoon\LagoonQueryBase;

/**
 * Update a project using the grpahql api.
 */
class FindByName extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys() {
    return ['name'];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
query FindByName(\$name: String!) {
  projectByName(name: \$name) {
    %s
  }
}
QUERY;
  }
}
