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
   * {@inheritdoc}
   */
  public function validate() {
    $expected = $this->expectedKeys();
    $variables = $this->getVariables();
    $missing = array_diff($expected, array_keys($variables));

    assert(count($missing) === 0, "Keys [" . implode(', ', $missing) . "] exist.");
  }

  /**
   * Set the variables for this instance.
   */
  public function setVariables($variables = []) {
    $this->variables = $variables;
    return $this;
  }

  /**
   * Get the assigned variables.
   */
  public function getVariables() {
    return $this->variables;
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

  final public function getQuery() {
    return sprintf($this->query(), implode(',', $this->fieldList));
  }

  /**
   * {@inheritdoc}
   */
  final public function execute() {
    $this->validate();
    return $this->client->response($this-> getQuery(), $this->variables);
  }
}
