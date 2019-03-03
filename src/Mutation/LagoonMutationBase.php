<?php

namespace Lagoon\Mutation;

use Lagoon\LagoonClientInterface;

/**
 * Base class for providing mutations.
 */
abstract class LagoonMutationBase implements LagoonMutationInterface {

  /**
   * The client.
   *
   * @var Lagoon\LagoonClientInterface
   */
  protected $client;

  /**
   * {@inheritdoc}
   */
  public function __construct(LagoonClientInterface $client) {
    $this->client = $client;
  }

  /**
   * Get the keys to validate.
   *
   * @return array
   */
  protected abstract function expectedKeys();

  /**
   * Validate the the provided variables.
   *
   * This ensures that each mutation can validate the data provided
   * by the user before issuing the query.
   *
   * @throws \Exception
   */
  protected function validate(array $variables = []) {
    $missing = array_diff($this->expectedKeys(), array_keys($variables));
    assert(count($missing) === 0, "Keys [" . implode(', ', $missing) . "] missing.");
  }

  /**
   * The graphql string for the mutation.
   *
   * @return stirng
   */
  protected abstract function query();

  /**
   * {@inheritdoc}
   */
  public function execute(array $variables = []) {
    $this->validate($variables);
    return $this->client->json($this->query(), $variables);
  }
}
