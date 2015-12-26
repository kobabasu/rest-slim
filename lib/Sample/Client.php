<?php
namespace Lib\Sample;

class Client {

  private $service;

  public function __construct(ServiceIF $service) {
    $this->service = $service;
  }

  public function say($word) {
    return $this->service->say($word);
  }
}
