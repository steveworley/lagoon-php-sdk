<?php

namespace Lagoon\Operation;

use Lagoon\Operation\LagoonOperationBase;
use Lagoon\Query\Environment\FindByOpenshiftProject;
use Lagoon\Mutation\Environment\AddVariable;
use Lagoon\Mutation\Environment\DeleteVariable;
use Lagoon\Mutation\Environment\Delete;
use Lagoon\Mutation\Environment\DeployPullRequest;
use Lagoon\Mutation\Environment\Update;
use Lagoon\Query\Environment\All;

/**
 * Notification graphql operations.
 */
class Environment extends LagoonOperationBase {

  /**
   * Naming constants to use throughout the class.
   */
  const ALL = 'all';
  const FIND_BY_OPENSHIFT = 'find_by_openshift';
  const ADD_VAR = 'add_var';
  const DELETE_VAR = 'delete_var';
  const DELETE = 'delete';
  const UPDATE = 'update';
  const DEPLOY_PR = 'deploy_pr';

  /**
   * {@inheritdoc}
   */
  protected function bind() {
    $this
      ->addQuery(self::ALL, All::class)
      ->addQuery(self::FIND_BY_OPENSHIFT, FindByOpenshiftProject::class)
      ->addMutation(self::ADD_VAR, AddVariable::class)
      ->addMutation(self::DELETE_VAR, DeleteVariable::class)
      ->addMutation(self::DELETE, Delete::class)
      ->addMutation(self::UPDATE, Update::class)
      ->addMutatoin(self::DEPLOY_PR, DeployPullRequest::class);
  }

  /**
   * Fetch all environments from Lagoon.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function all() {
    return $this->query(self::ALL);
  }

  /**
   * Execute the openshift project name query.
   *
   * @param string $name
   *   The project name.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function withOpenshiftProject($name) {
    return $this->query(SELF::FIND_BY_OPENSHIFT, ['openshiftProjectName' => $name]);
  }

  /**
   * Prepare the delete environment mutation.
   *
   * @param string $name
   *   The name of the environment.
   * @param string $project
   *   The name of the project.
   * @param bool $execute
   *   Should the operation be executed.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function delete($name, $project, $execute = false) {
    return $this->mutation(self::DELETE, [
      'name' => $name,
      'project' => $project,
      'execute' => $execute,
    ]);
  }

  /**
   * Perform an update operation.
   *
   * @param int $id
   *   The environment Id.
   * @param array $patch
   *   The fields to update.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function update($id, $patch) {
    return $this->mutation(self::UPDATE, [
      'id' => $id,
      'patch' => $patch,
    ]);
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

  /**
   * Prepare the delete variable mutaiton.
   *
   * @param int $id
   *   The id of the environmentt var.
   *
   * @return Lagooon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function deleteVariable($id) {
    return $this->mutation(self::DELETE_VAR, ['id' => $id]);
  }

  /**
   * Deploy a pull request environment.
   *
   * @param string $name
   *   The project name
   * @param int $numbe
   *   The PR number
   * @param string $headName
   *   The branch we're merging.
   * @param string $headRef
   *   The ref of the branch we're merging.
   * @param string $baseName
   *   The branch were merging in to.
   * @param string $baseRef
   *   The ref of the branch we're merging in to.
   *
   * @return Lagoon\LagoonQueryInterface
   *   The lagoon query object.
   */
  public function deployPullRequest($name, $number, $title, $headName, $headRef, $baseName, $baseRef) {
    $payload = [
      'name' => $name,
      'number' => $number,
      'title' => $title,
      'headBranchName' => $headName,
      'headBranchRef' => $headRef,
      'baseBranchName' => $baseName,
      'baseBranchRef' => $baseRef,
    ];
    return $this->mutation(self::DEPLOY_PR, $payload);
  }
}
