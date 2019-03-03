<?php

namespace Lagoon\Query\Project;

use Lagoon\Query\LagoonQueryBase;

/**
 * Find a project by the git url.
 */
class FindByGit extends LagoonQueryBase {

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
  projectByGitUrl(\$gitUrl: String) {
    id
    name
  }
}
QUERY;
  }
}
