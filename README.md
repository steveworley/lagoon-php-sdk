# Lagoon PHP SDK

[![CircleCI](https://circleci.com/gh/steveworley/lagoon-php-sdk.svg?style=svg&circle-token=0b96bf2aab7e227d9a6b528fe5dff25d4de6e537)](https://circleci.com/gh/steveworley/lagoon-php-sdk)

The *Lagoon SDK for PHP* makes it easy for developers to connect their applications to the Lagoon GraphQL service in PHP Code.

## Getting started

Define the `$endpoint` and `$token` to create a new client instance.

## Quick Examples

### Fetch all projects

``` php
<?php

use Lagoon\LagoonClient;

$client = new LagoonClient($endpoint, $token);
$customers = $client->customer()->all()->execute();
```

### Fetch all project names

``` php
<?php

use Lagoon\LagoonClient;

$client = new LagoonClient($endpoint, $token);
$customers = $client->project()->all()->fields(['name'])->execute();
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
$customers = $client->project()->add($project)->execute();
```
