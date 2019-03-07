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
   * Set the variables for this instance.
   */
  public function setVariables($variables = []);

  /**
   * Get the assigned variables.
   */
  public function getVariables();

  /**
   * The fields the query should return.
   *
   * @param array $fields
   *   A list of fields to add to the query.
   *
   * @return array
   *   An array of field names.
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
   * @return Lagoon\LagoonResponse
   */
  public function execute();

  /**
   * Return the query with the field list replacement.
   *
   * @return string
   *   The formatted GraphQL query.
   */
  public function getQuery();
}
