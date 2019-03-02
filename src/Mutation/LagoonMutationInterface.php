<?php

namespace Lagoon\Mutation;

use Lagoon\LagoonClientInterface;

/**
 * Interface for the mutations.
 */
interface LagoonMutationInterface {
  /**
   * Construct the mutation instance.
   *
   * @param Lagoon\LagoonClientInterface;
   *   The client.
   */
  public function __construct(LagoonClientInterface $client);

  /**
   * Execute the mutation
   *
   * @param array $variables
   *   The variables to send with the mutation.
   *
   * @return mixed
   */
  public function execute(array $variables = []);
}
