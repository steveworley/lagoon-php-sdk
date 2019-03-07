---
currentMenu: client
---

# The client object

The client object is built on the `euautomation/graphql-client` GraphQL client. Normally the operations will access the client implicitly and return the responses to your application; however if an operation isn't supported you can use the client directly to make requests to graphql.

## Request methods

### `raw()`

The raw method will return a Guzzle Response object without any additional parsing.

*Params*
- `query<string>`: The query string to send to Lagoon
- `variables[array]`: Any variables to use as replacements in the graphql query

``` php
$client->raw($query, $variables);
```

### `json()`

The json method will parse the Guzzle response and return a serialised json object.

*Params*
- `query<string>`: The query string to send to Lagoon
- `variables[array]`: Any variables to use as replacements in the graphql query

``` php
$client->json($query, $variables);
```

### `response()`

The response method will return a `Lagoon\LagoonResponse` object and does additional filtering on the data.

*Params*
- `query<string>`: The query string to send to Lagoon
- `variables<array>`: Any variables to use as replacements in the graphql query

``` php
$client->response($query, $variables);
```

## Headers

The Client object maintains a list of headers that it should send with each request. This list can be modified directly after a client has be instantiated.

*Note: The headers will be present to each request, both manual and operations to have different headers for different request you will need to create another instance of the client*

### `addHeader()`

Add a header to the request.

*Params*
- `key<string>`: The header name
- `value<string>`: The header value
