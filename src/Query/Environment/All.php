<?php

namespace Lagoon\Query\Environment;

use Lagoon\LagoonQueryBase;

class All extends LagoonQueryBase {

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
query findAll {
  allEnvironments {
    %s
  }
}
QUERY;
  }

}
