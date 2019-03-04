<?php

namespace Lagoon\Query\Openshift;

use Lagoon\LagoonQueryBase;

/**
 * Fetch all openshifts from Lagoon.
 */
class FetchAll extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<'QUERY'
{
  allOpenshifts {
    %s
  }
}
QUERY;
  }
}
