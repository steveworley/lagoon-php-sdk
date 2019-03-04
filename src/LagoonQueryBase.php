<?php

namespace Lagoon;

use Lagoon\LagoonClientInterface;
use Lagoon\LagoonResult;
use Lagoon\LagoonQueryInterface;

/**
 * Base class for providing mutations.
 */
abstract class LagoonQueryBase implements LagoonQueryInterface {

  /**
   * @var Lagoon\LagoonClientInterface;
   */
  protected $client;

  /**
   * @var array
   */
  protected $fieldList;

  /**
   * @var array
   */
  protected $variables;

  /**
   * {@inheritdoc}
   */
  public function __construct(LagoonClientInterface $client) {
    $this->client = $client;
    $this->fieldList = ['id'];
    $this->variables = [];
  }

  /**
   * Get the keys to validate.
   *
   * @return array
   *   An array of expected keys for the input to the function.
   */
  protected abstract function expectedKeys();

  /**
   * The graphql string for the mutation.
   *
   * @return stirng
   *   A query string.
   */
  protected abstract function query();

  /**
   * Validate the the provided variables.
   *
   * This ensures that each mutation can validate the data provided
   * by the user before issuing the query.
   *
   * @throws \Exception
   */
  protected function validate() {
    $missing = array_diff($this->expectedKeys(), array_keys($this->variables));
    assert(count($missing) === 0, "Keys [" . implode(', ', $missing) . "] missing.");
  }

  /**
   * Set the variables for this instance.
   */
  final public function setVariables($variables = []) {
    $this->variables = $variables;
    return $this;
  }

  /**
   * The fields the query should return.
   *
   * @param array $fields
   *   A list of fields to add to the query.
   *
   * @return array
   *   An array of field names.
   */
  final public function fields(array $fields = []) {
    $this->fieldList = $fields;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  final public function execute() {
    $this->validate();
    $query = sprintf($this->query(), implode(',', $this->fieldList));
    return LagoonResult::fromJSON($this->client->json($query, $this->variables));
  }
}
