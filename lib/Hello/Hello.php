<?php
namespace Lib\Hello;

class Hello implements HelloInterface {

  private $word;

  public function __construct($word) {
    $this->word = $word;
  }

  public function say() {
    echo 'say: ' . $this->word . PHP_EOL;
  }
}
