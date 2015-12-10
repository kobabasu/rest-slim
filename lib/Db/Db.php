<?php
namespace Lib\Db;

abstract class Db {

  protected $debug = false;

  protected $dbh;

  public function __construct() {
    if (defined('DEBUG')) $this->debug = DEBUG;
    $db = Connect::getInstance();
    $this->dbh = $db->getConnection();
  }

  public function close() {
    $this->dbh = null;
  }

  protected function debug($e) {
    if ($this->debug) echo $e;
  }

  abstract public function execute($sql, $values);
}
