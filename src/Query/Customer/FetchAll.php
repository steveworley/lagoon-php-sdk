<?php

namespace Lagoon\Query\Customer;

use Lagoon\LagoonQueryBase;

/**
 * Fetch all customers from Lagoon.
 */
class FetchAll extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys(array $variables = []) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  protected function query() {
    return <<<'QUERY'
query findAll {
  allCustomers {
    %s
  }
}
QUERY;
  }
}
