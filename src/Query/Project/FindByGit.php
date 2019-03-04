<?php

namespace Lagoon\Query\Project;

use Lagoon\LagoonQueryBase;

/**
 * Find a project by the git url.
 */
class FindByGit extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys(array $variables = []) {
    return ['gitUrl'];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
query ProjectByGit(\$gitUrl: string) {
  projectByGitUrl(gitUrl: \$gitUrl) {
    %s
  }
}
QUERY;
  }
}
