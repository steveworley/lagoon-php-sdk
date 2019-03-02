<?php

namespace Lagoon\Operation;

use Lagoon\LagoonClientInterface;
use Lagoon\Mutation\LagoonMutationInterface;

/**
 * Build a list of operations under a namespce.
 */
abstract class LagoonOperationBase implements LagoonOperationInterface {

  /**
   * The client.
   *
   * @var Lagoon\LagoonClientInterface;
   */
  protected $client;

  /**
   * A list of supported mutations.
   */
  protected $mutations = [];

  /**
   * A list of supported queries.
   */
  protected $queries = [];

  /**
   * Construct the operation.
   */
  public function __construct(LagoonClientInterface $client) {
    $this->client = $client;
    $this->bind();
  }

  /**
   * Bind the initial mutations and queries supported by this operation.
   *
   * @return void
   */
  abstract protected function bind();

  /**
   * Add a mutation after the class has been instantiated.
   *
   * @param string $key
   *   The key for the mutation.
   * @param Lagoon\Mutation\LagoonMutationInterface $mutation
   *   A valid mutation.
   */
  public function addMutation($key, LagoonMutationInterface $mutation) {
    $this->mutations[$key] = $mutation;
    return $this;
  }

  /**
   * Add a mutation after the class has been instantiated.
   *
   * @param string $key
   *   The key for the mutation.
   * @param Lagoon\Mutation\LagoonMutationInterface $mutation
   *   A valid mutation.
   */
  public function addQuery($key, $query) {
    $this->queries[$key] = $query;
    return $this;
  }

  /**
   * Fetch the mutation from the configured list.
   *
   * @return Lagoon\Mutation\LagoonMutationInterface
   */
  public function mutation($name) {
    return $this->mutations[$name];
  }

  /**
   * Fetch the query from the configured list.
   *
   * @return Lagoon\Mutation\LagoonMutationInterface
   */
  public function query($name) {
    return $this->queries[$name];
  }
}
