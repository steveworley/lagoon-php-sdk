---
currentMenu: gettingstarted
---

The Lagoon PHP SDK enables PHP developers to interact easily with the Lagoon GraphQL API in their PHP applications.

## Getting started

1. Have your access token and lagoon endpoint handy
2. Install the SDK with composer

### Requirements

Lagoon PHP SDK requires PHP 7 or greater on your machine.

### Installation

#### Composer

Add the SDK as a dependency to your project.

```
$ composer require steveworley/lagoon-php-sdk
```

### Client Overview

The SDK provides the `LagoonClient` object which is the main entry point into the Lagoon API. The client has methods which relate to different operations of the API and can all be accessed publicly. Each operation has a number of queries or mutations that will be exposed via methods.

#### Example all projects

For example: *Querying for all projects*

1. Access the `projects()` operations of a `LagoonClient` instance.
2. Access the `all()` task of the project operation.
3. `execute()` the task

```php
$client = new LagoonClient($endpoint, $token);
$projects = $client->projects()->all()->execute()
```

#### Example all projects with fields

Each task has a default list of fields it will request from the API (in most cases this will be `id`) you can override the fields that will be request to return more information from GraphQL.

For example: *Get the names of all projects*

1. Access the `projects()` operations of a `LagoonClient` instance.
2. Access the `all()` task of the project operation.
3. Request additional `fields()` from the task
4. `execute()` the task

```php
$client = new LagoonClient($endpoint, $token);
$projects = $client->projects()->all()->fields(['id', 'name'])->execute()
```

