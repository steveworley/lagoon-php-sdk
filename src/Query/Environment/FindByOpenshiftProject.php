<?php

namespace Lagoon\Query\Environment;

use Lagoon\LagoonQueryBase;

/**
 * Find a project by the git url.
 */
class FindByOpenshiftProject extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys(array $variables = []) {
    return ['openshiftProjectName'];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
query EnvironmentByOpenshiftProjectName(\$openshiftProjectName: String!) {
  environmentByOpenshiftProjectName(openshiftProjectName: \$openshiftProjectName) {
    %s
  }
}
QUERY;
  }
}
