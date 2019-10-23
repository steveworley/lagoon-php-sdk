<?php

namespace Lagoon\Query\Project;

use Lagoon\LagoonQueryBase;

class FetchPrivateKey extends LagoonQueryBase {

  protected function expectedKeys()
  {
    return [
      "name"
    ];
  }

  protected function query()
  {
    return <<<QUERY
query FetchPrivateKey {
  projectByName(name:\$name) {
    privateKey
  }
}
QUERY;

  }
}
