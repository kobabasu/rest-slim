<?php
namespace Lib\Db;

class Get {
  public function __construct() {
    $db = Connect::getInstance();
    $this->_dbh = $db->getConnection();
  }

  public function exec($sql, $values = array()) {
    try {
      $stmt = $this->_dbh->prepare($sql);
      $stmt->execute($values);

      while ($rows = $stmt->FETCH(\PDO::FETCH_ASSOC)) {
        return $rows;
      }

      $this->_dbh = null;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}
