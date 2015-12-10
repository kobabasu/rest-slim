<?php
namespace Lib\Db;

class Connect {

  private $_debug = false;

  private $host = DB_HOST;
  private $username = DB_USERNAME;
  private $password = DB_PASSWORD;
  private $database = DB_NAME;

  private $connection;
  private static $instance;

  public static function getInstance() {
    if (!self::$instance) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  private function __construct() {
    $this->debug = DEBUG;

    try {
      $this->connection = new \PDO(
        "mysql:host=$this->host;dbname=$this->database",
        $this->username,
        $this->password
      );

      if ($this->debug) {
        $this->connection->setAttribute(
          \PDO::ATTR_ERRMODE,
          \PDO::ERRMODE_EXCEPTION
        );
      }
    } catch (PDOException $e) {
      if ($this->debug) echo $e->getMessage();
    }
  }

  final function __clone() {
  }

  public function getConnection() {
    return $this->connection;
  }
}
