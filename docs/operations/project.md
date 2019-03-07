---
currentMenu: operationsProject
---

# Project Operations

The SDK supprots querying for and mutating the projects available in your Lagoon instance.

## Queries

### `all()`

Find all projects.

*Example*

```php
$client = new LagoonClient($endpoint, $token);
$client->project()->all()->execute();
```

### `withName()`

Find a project with a name.

*Example*

```php
$client = new LagoonClient($endpoint, $token);
$client->project()->withName('my-test-project')->execute();
```

### `withGit()`

Find a project by their git URL.

*Example*

```php
$client = new LagoonClient($endpoint, $token);
$client->project()->withGit('my-test-project')->execute();
```

## Mutations

### `add()`

Add a project to Lagoon.

*Parameters `<array>`*

```php
$project = [
  'name' => 'name of the project',
  'customer' => 1,
  'openshift' => 1,
  'gitUrl' => 'git@github.com/team/project.git',
  'productionEnvironment' => 'master',
  'branches' => 'master'
];
```

*Example*

```php
$client = new LagoonClient($endpoint, $token);
$response = $client->project()->add($project)->execute();
$response->all();
```

### `update()`

Update a project in Lagoon.

*Parameters `<array>`*

```php
$project = [
  'id' => 1,
  'name' => 'name of the project',
  'customer' => 1,
  'openshift' => 1,
  'gitUrl' => 'git@github.com/team/project.git',
  'productionEnvironment' => 'master',
  'branches' => 'master'
];
```

*Example*

```php
$client = new LagoonClient($endpoint, $token);
$client->project()->udpate($project)->execute();
```
