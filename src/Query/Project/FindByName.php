<?php

namespace Lagoon\Query\Project;

use Lagoon\Query\LagoonQueryBase;

/**
 * Update a project using the grpahql api.
 */
class FindByName extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function validate(array $variables = []) {
    return true;
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
{
  projectByName(\$name: String) {
    id
    name
  }
}
QUERY;
  }
}
