<?php
namespace Lib\Slim;

abstract class Extend {

  protected $debug = false;
  protected $app;

  public function __construct($app) {
    if (defined('DEBUG')) $this->debug = DEBUG;
    $this->app = $app;
  }
}
