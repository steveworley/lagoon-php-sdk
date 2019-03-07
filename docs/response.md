---
currentMenu: response
---

# The Response object

Each mutation or query using the operation handlers will return an instance of `Lagoon\LagoonResponse`. This helps normalise the response from GraphQL to give your application a standard way of access the result of your query or mutation.

The response object will be returned if the request results in a success or an error.

## Accessing the results

The results can be accessed with two methods; `all` or `toJson`. This provides a uniform way to acces the data as a typical GraphQL response is keyed by the query/mutation that was run. Error handling is taken care of by the `LagoonClient` and it will construct a response object and it will set the error properties.

*Note: If the query or mutation doesn't return anything, `all()` will return `NULL` and the Reponse is not treated as an error.*

### `all()`

The `all()` method on the response object will return all data in a standard `json_decoded` fashion. This will be an array of standard objects.

*Example*

``` php
$response = $client->project()->all()->execute();
var_dump($response->all());
/**
array(2) {
  [0]=>
  object(stdClass)#36 (1) {
    ["id"]=>
    int(1)
  }
  [1]=>
  object(stdClass)#33 (1) {
    ["id"]=>
    int(3)
  }
}
*/
```

### `toJson()`

The `toJson` method will return all data in a serialised JSON format.

``` php
$response = $client->project()->all()->execute();
var_dump($response->toJson());
/*
string(19) "[{"id":1},{"id":2}]"
*/
```

### Accessing the errors

The errors will range from Guzzle exceptions to GraphQL rejections. Both are treated the same way and have the same interface for accessing data about why the request failed.

### `errors()`

Errors are stored as an array on the response object, like the `all()` method this will return all errors that happened during the request.

``` php
$response = $client->project()->all()->execute();
var_dump($response->errors());
/*
array(1) {
  [0]=>
  object(stdClass)#33 (1) {
    ["message"]=>
    string(71) "Forbidden - Invalid Auth Token: Error decoding token: invalid signature"
  }
}
*/
```

### `hasErrors()`

This method is a quick way to determine if the response failed and returns a boolean value.

``` php
$response = $client->project()->all()->execute();
if ($response->hasErrors()) {
  return;
}
```
