<?php

namespace Lagoon;

interface LagoonResponseInterface {

  /**
   * Construct a new LagoonResponse object.
   */
  public function __construct($response);

  /**
   * Return all data associated with this response.
   *
   * @return array|null
   */
  public function all();

  /**
   * Return the first object in the response.
   */
  public function first();

  /**
   * Return all errors associated with this response.
   *
   * @return array|null
   */
  public function errors();

  /**
   * Determine if this response has any errors.
   *
   * @return bool
   */
  public function hasErrors();

  /**
   * Display this response as a JSON string.
   *
   * @return string
   */
  public function toJson();
}
