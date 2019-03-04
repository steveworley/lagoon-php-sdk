<?php

namespace Lagoon\Query\Project;

use Lagoon\LagoonQueryBase;

/**
 * Fetch all projects from Lagoon.
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
query findAll {
  allProjects {
    %s
  }
}
QUERY;
  }
}
