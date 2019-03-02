<?php

namespace Lagoon;

/**
 * The LagoonClientInterace.
 */
interface LagoonClientInterface {

  /**
   * Build a new client.
   */
  public function __construct($endpoint,$token);

  /**
   * Return the raw guzzle response.
   *
   * @param string $query
   *   The query to send to Graphql
   * @param array $variables
   *   The variables to replace in the graphql query.
   *
   * @return mixed|\Psr\Http\Message\ResponseInterface
   */
  public function raw($query, array $variables = []);

  /**
   * Make a GraphQL Request and get the response body in JSON form.
   *
   * @param string $query
   *   The query to send to Graphql
   * @param array $variables
   *   The variables to replace in the graphql query.
   *
   * @return mixed
   */
  public function json($query, array $variables = []);

  /**
   * Add a header to the request after the client has been initialised.
   *
   * @param string $header
   *   The header to set.
   * @param string $value
   *   THe value to give the header
   *
   * @return Lagoon\LagoonClientInterface
   */
  public function addHeader($header, $value);
}
