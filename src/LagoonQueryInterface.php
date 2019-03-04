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
   * Validate the the provided variables.
   *
   * This ensures that each mutation can validate the data provided
   * by the user before issuing the query.
   *
   * @throws \Exception
   */
  public function validate();

  /**
   * Execute the mutation
   *
   * @return mixed
   */
  public function execute();
}
