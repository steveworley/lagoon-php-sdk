<?php

namespace Lagoon;

use GuzzleHttp\Psr7\Response;

/**
 * The LagoonResult class.
 */
class LagoonResult implements LagoonResultInterface {

  /**
   * Factory method to create a new result from a JSON response.
   *
   * @param string $result
   *   The result from an API request.
   *
   * @return Lagoon\LagoonResult
   *   The lagoon result object.
   */
  public static function fromJSON($result) {
    return new self($result);
  }

  /**
   * Factory methodt to create a new result from a raw response.
   *
   * @param GuzzleHttp\Psr7\Response $response
   *   The response object.
   *
   * @return Lagoon\LagoonResult
   *   The lagoon result object.
   */
  public static function fromRaw(Response $response) {
    $data = json_decode($response->getBody()->getContents());
    return new self($data);
  }

  /**
   * Create a new result instance.
   *
   * @param mixed $data
   *   The result.
   */
  public function __construct($data) {
    $this->data = $data;
  }

  /**
   * Output the data.
   *
   * @return string
   *   The return value of the data.
   */
  public function __toString() {
    return json_encode($this->data);
  }

  /**
   * Output the data.
   *
   * @return string
   *   The return value of the data.
   */
  public function output() {
    return $this->__toString();
  }

  /**
   * Output status of the command.
   *
   * @return int
   *   The status of the command.
   */
  public function status() {
    return 0;
  }
}
