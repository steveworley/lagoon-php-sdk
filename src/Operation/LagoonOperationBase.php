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
   * @param string $handler
   *   A valid mutation class.
   */
  public function addMutation($key, $handler) {
    $this->mutations[$key] = $handler;
    return $this;
  }

  /**
   * Add a mutation after the class has been instantiated.
   *
   * @param string $key
   *   The key for the mutation.
   * @param string $handler
   *   A valid mutation class.
   */
  public function addQuery($key, $handler) {
    $this->queries[$key] = $handler;
    return $this;
  }

  /**
   * Fetch the mutation from the configured list.
   *
   * @param string name
   *   The class name to fetch.
   * @param array $variables
   *   The variables to build.
   *
   * @return Lagoon\Mutation\LagoonMutationInterface
   */
  public function mutation($name, $variables = []) {
    $mutation = new $this->mutations[$name]($this->client);
    return $mutation->setVariables($variables);
  }

  /**
   * Fetch the query from the configured list.
   *
   * @param string name
   *   The class name to fetch.
   * @param array $variables
   *   The variables to build.
   *
   * @return Lagoon\Mutation\LagoonMutationInterface
   */
  public function query($name, $variables = []) {
    $query = new $this->queries[$name]($this->client);
    return $query->setVariables($variables);
  }
}
