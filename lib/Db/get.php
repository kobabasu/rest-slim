<?php
namespace Lib\Db;

class Get extends Db {
  public function execute($sql, $values = array()) {
    try {
      $stmt = $this->_dbh->prepare($sql);
      $stmt->execute($values);

      return $stmt->FETCHALL(\PDO::FETCH_CLASS);

    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}
