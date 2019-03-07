<?php

namespace Lagoon;

use EUAutomation\GraphQL\Client;
use EUAutomation\GraphQL\Response;
use GuzzleHttp\Exception\ClientException;

/**
 * The LagoonClient.
 */
class LagoonClient implements LagoonClientInterface {

  /**
   * The graphql client.
   *
   * @var EUAutomation\GraphQL\Client
   */
  protected $client;

  /**
   * An array of additional headers to send with the request.
   */
  protected $headers = [];

  /**
   * A list of operations that this class supports.
   */
  protected $operations = [];

  /**
   * {@inheritdoc}
   */
  public function __construct($endpoint, $token) {
    $this->client = new Client($endpoint);
    $this->headers = [
      'Authorization' => "Bearer {$token}"
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function addHeader($key, $value) {
    $this->headers[$key] = $value;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function raw($query, array $variables = []) {
    return $this->client->raw($query, $variables, $this->headers);
  }

  /**
   * {@inheritdoc}
   */
  public function response($query, array $variables = []) {
    try {
      $response = $this->client->response($query, $variables, $this->headers);
    } catch (ClientException $error) {
      $data = $error->getResponse();
      $data = json_decode($data->getBody()->getContents());
      $response = new Response($data);
    }
    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function json($query, array $variables = []) {
    return $this->client->json($query, $variables, $this->headers);
  }

  /**
   * Dynamically load the operations supported by graphql.
   */
  public function __call($method, $arguments) {
    $class = 'Lagoon\\Operation\\' . ucfirst($method);
    if (class_exists($class)) {
      if (empty($this->operations[$method])) {
        $this->operations[$method] = new $class($this, $arguments);
      }
      return $this->operations[$method];
    }
    return parent::__call($method, $arguments);
  }
}
