<?php
namespace Lib\Db;

class Connect {
  private $_connection;
  private static $_instance;
  private $_host = DB_HOST;
  private $_username = DB_USERNAME;
  private $_password = DB_PASSWORD;
  private $_database = DB_NAME;

  public static function getInstance() {
    if (!self::$_instance) {
      self::$_instance = new self();
    }

    return self::$_instance;
  }

  private function __construct() {
    try {
      $this->_connection = new \PDO(
        "mysql:host=$this->_host;dbname=$this->_database",
        $this->_username,
        $this->_password
      );
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  private function __clone() {
  }

  public function getConnection() {
    return $this->_connection;
  }
}
