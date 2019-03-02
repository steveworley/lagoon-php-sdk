<?php

namespace Lagoon\Query;

use Lagoon\LagoonClientInterface;

/**
 * Base class for providing queries.
 */
abstract class LagoonQueryBase implements LagoonQueryInterface {

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
   * The graphql string for the query.
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
