# Lagoon PHP SDK

The *Lagoon SDK for PHP* makes it easy for developers to connect their applications to the Lagoon GraphQL service in PHP Code.

## Getting started

Require the package using [Composer](https://getcomposer.org/):

```
composer require uselagoon/lagoon-php-sdk
```

## Quick Examples

### Fetch all projects

```php
<?php

use Lagoon\LagoonClient;
use Lagoon\LagoonResponse;

// The full URL to the GraphQL endpoint.
$endpoint = "https://lagoon.api:8000/graphql";

// The Token to use to connect to the LagoonAPI. 
$token = "APITokenFromLagoonAPI";

$client = new LagoonClient($endpoint, $token);

/** @var LagoonResponse $projects */
$response = $client->project()->all()->execute();

if ($response->hasErrors()) {
  throw new \Exception("There were errors returned from the GraphQL API: " . implode(PHP_EOL, $response->errors()));
}
else {
  $projects = $response->all();
  print "Projects Found: " . count($projects);
  print_r($projects);
}
```

### Fetch all project names

``` php
<?php

use Lagoon\LagoonClient;

$client = new LagoonClient($endpoint, $token);
$projects = $client->project()->all()->fields(['name'])->execute();
```

### Add a project

``` php
<?php

use Lagoon\LagoonClient;

$client = new LagoonClient($endpoint, $token);
$project = [
  'name' => 'my-proejct',
  'customer' => 1,
  'openshift' => 1,
  'gitUrl' => 'git@github.com:test/test.git'
  'productEnvironment' => 'master',
  'branches' => 'master',
];
$response = $client->project()->add($project)->execute();
```

## About this Package


This project was originally developed by @steveworley et al in the repo https://github.com/steveworley/lagoon-php-sdk.
It is currently being improved upon to be released as officially supported by the Lagoon Team. 
