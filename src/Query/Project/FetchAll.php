<?php

namespace Lagoon\Query\Project;

use Lagoon\Query\LagoonQueryBase;

class FetchAll extends LagoonQueryBase {
  protected function validate(array $variables = []) {
    return true;
  }

  protected function query() {
    return <<<'QUERY'
{
  allProjects {
    id
    name
    customer { id }
    gitUrl
  }
}
QUERY;
  }
}
