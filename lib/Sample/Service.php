<?php
namespace Lib\Sample;

class Service extends ServiceSkel implements ServiceIF {

  public function say($word) {
    echo 'service: ' . $word . PHP_EOL;
  }
}
