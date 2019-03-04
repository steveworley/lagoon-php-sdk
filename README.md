# Lagoon PHP SDK

The *Lagoon SDK for PHP* makes it easy for developers to connect their applications to the Lagoon GraphQL service in PHP Code.

## Getting started

Define the `$endpoint` and `$token` to create a new client instance.

## Quick Examples

### Fetch all projects

```
<?php

use Lagoon\LagoonClient;

$client = new LagoonClient($endpoint, $token);
$customers = $client->customer()->all()->execute();
```

### Fetch all project names

```
<?php

use Lagoon\LagoonClient;

$client = new LagoonClient($endpoint, $token);
$customers = $client->project()->all()->fields(['name'])->execute();
```

### Add a project

```
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
