<?php

namespace Lagoon\Query\Customer;

use Lagoon\LagoonQueryBase;

/**
 * Fetch all customers from Lagoon.
 */
class FindByName extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys() {
    return ['name'];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<QUERY
query FindByName(\$name: String!) {
  customerByName(name: \$name) {
    %s
  }
}
QUERY;
  }
}
