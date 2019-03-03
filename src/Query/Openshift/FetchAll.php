<?php

namespace Lagoon\Query\Openshift;

use Lagoon\Query\LagoonQueryBase;

/**
 * Fetch all openshifts from Lagoon.
 */
class FetchAll extends LagoonQueryBase {

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
    return <<<'QUERY'
{
  allOpenshifts {
    id
    name
  }
}
QUERY;
  }
}
