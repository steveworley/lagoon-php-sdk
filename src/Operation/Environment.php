<?php

namespace Lagoon\Operation;

use Lagoon\Operation\LagoonOperationBase;
use Lagoon\Query\Environment\FindByOpenshiftProject;
use Lagoon\Mutation\Environment\AddVariable;

/**
 * Notification graphql operations.
 */
class Environment extends LagoonOperationBase {

  /**
   * Naming constants to use throughout the class.
   */
  const FIND_BY_OPENSHIFT = 'find_by_openshift';
  const ADD_VAR = 'add_var';

  /**
   * {@inheritdoc}
   */
  protected function bind() {
    $this
      ->addQuery(self:: FIND_BY_OPENSHIFT, FindByOpenshiftProject::class)
      ->addMutation(self::ADD_VAR, AddVariable::class);
  }

  /**
   * Execute the openshift projectn ame query.
   *
   * @param string $name
   *   The project name.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function withOpenshiftProject($name) {
    return $this->query(SELF::UsersBySshKey, ['openshiftProjectName' => $name]);
  }

  /**
   * Execute the add variable mutation.
   *
   * @param array $variables
   *   The variables to send to the mutation.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function addVariable(array $varaibles = []) {
    return $this->mutation(self::ADD_VAR, $varaibles);
  }
}
