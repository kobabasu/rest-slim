<?php
namespace Lib\Db;

abstract class Db {

  protected $_ids;
  protected $_dbh;

  public function __construct($ids = array()) {
    $this->_ids = $ids;
    $db = Connect::getInstance();
    $this->_dbh = $db->getConnection();
  }

  public function close() {
    $this->_dbh = null;
  }

  abstract public function exec($sql, $values);
}
