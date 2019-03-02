<?php

namespace Lagoon\Operation;

use Lagoon\LagoonClientInterface;


interface LagoonOperationInterface {

  public function __construct(LagoonClientInterface $client);

  public function mutation($name);

  public function query($name);

}
