<?php
namespace Lib\Db;

abstract class Db {

  protected $_debug = false;

  protected $_ids;
  protected $_dbh;

  public function __construct($ids = array()) {
    $this->_ids = $ids;
    $this->_debug = DEBUG;
    $db = Connect::getInstance();
    $this->_dbh = $db->getConnection();
  }

  public function close() {
    $this->_dbh = null;
  }

  protected function _debug($e) {
    if ($this->_debug) echo $e;
  }

  abstract public function execute($sql, $values);
}
