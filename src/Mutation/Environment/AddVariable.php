<?php

namespace Lagoon\Mutation\Environment;

use Lagoon\LagoonQueryBase;

/**
 * Add a project using the graphql api.
 */
class AddVariable extends LagoonQueryBase {

  /**
   * {@inheritdoc}
   */
  protected function expectedKeys(array $variables = []) {
    return [
      'type',
      'typeId',
      'scope',
      'name',
      'value',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function query()
  {
    return <<<QUERY
mutation AddEnvironmentVar(
  \$type: String!
  \$typeId: Int!
  \$scope: String!
  \$name: String!
  \$value: String!
) {
  addEnvVariable(input: {
    type: \$type,
    typeId: \$typeId,
    scope: \$scope,
    name: \$name,
    value: \$value,
  } ) {
    %s
  }
}
QUERY;
  }
}
