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
   * Validate the the provided variables.
   *
   * This ensures that each mutation can validate the data provided
   * by the user before issuing the query.
   *
   * @throws \Exception
   */
  protected abstract function validate(array $variables = []);

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
