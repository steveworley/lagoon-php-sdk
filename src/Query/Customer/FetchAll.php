<?php

namespace Lagoon\Query\Customer;

use Lagoon\Query\LagoonQueryBase;

/**
 * Fetch all customers from Lagoon.
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
  allCustomers {
    id
    name
  }
}
QUERY;
  }
}
