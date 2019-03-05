---
currentMenu: operationsCustomers
---

# Customer Operations

The SDK supprots querying for and mutating the customers available in your Lagoon instance.

## Queries

### `all()`

Find all customers.

*Example*

```php
$client = new LagoonClient($endpoint, $token);
$client->customer()->all()->execute();
```

### `withName()`

Find a customer with a name.

*Example*

```php
$client = new LagoonClient($endpoint, $token);
$client->customer()->withName('my-customer')->execute();
```

## Mutations

### `add()`

Add a customer to Lagoon.

*Parameters `<array>`*

```php
$customer = [
  'name' => 'Customer',
  'privateKey' => 'key',
];
```

*Throws*

```
\Exception
```

*Example*

```php
$client = new LagoonClient($endpoint, $token);
$client->customer()->add($customer)->execute();
```
