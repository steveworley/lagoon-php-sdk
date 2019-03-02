<?php

namespace Lagoon\Query;

use Lagoon\LagoonClientInterface;

/**
 * Interface for the query.
 */
interface LagoonQueryInterface {
  /**
   * Construct the query instance.
   *
   * @param Lagoon\LagoonClientInterface;
   *   The client.
   */
  public function __construct(LagoonClientInterface $client);

  /**
   * Execute the query
   *
   * @param array $variables
   *   The variables to send with the query.
   *
   * @return mixed
   */
  public function execute(array $variables = []);
}
