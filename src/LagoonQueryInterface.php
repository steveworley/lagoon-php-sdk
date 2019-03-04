<?php

namespace Lagoon;

use Lagoon\LagoonClientInterface;

/**
 * Interface for the mutations.
 */
interface LagoonQueryInterface {
  /**
   * Construct the mutation instance.
   *
   * @param Lagoon\LagoonClientInterface;
   *   The client.
   */
  public function __construct(LagoonClientInterface $client);

  /**
   * Set the fields on the instance.
   *
   * @param array $fields
   *   The fields.
   */
  public function fields(array $fields = []);

  /**
   * Execute the mutation
   *
   * @return mixed
   */
  public function execute();
}
