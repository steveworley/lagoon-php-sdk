<?php

namespace Lagoon;

class LagoonResponse {

  /**
   * All returned data from the endpoint.
   *
   * @var array|null
   */
  protected $data;

  /**
   * Any errors that the request had.
   *
   * @var array|null
   */
  protected $errors;

  /**
   * {@inheritdoc}
   */
  public function __construct($response) {
    if (isset($response->data)) {
      // Remove the query key.
      $this->data = reset($response->data);
    }

    if (isset($response->errors)) {
      $this->errors = $response->errors;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function all() {
    return $this->data;
  }

  /**
   * {@inheritdoc}
   */
  public function first() {
    return is_array($this->data) ? reset($this->data) : $this->data;
  }

  /**
   * {@inheritdoc}
   */
  public function errors() {
    return $this->errors;
  }

  /**
   * {@inheritdoc}
   */
  public function hasErrors() {
    return is_array($this->errors) && (bool) count($this->errors);
  }

  /**
   * {@inheritdoc}
   */
  public function toJson() {
    return json_encode($this->data);
  }

}
