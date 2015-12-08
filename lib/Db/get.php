<?php
namespace Lib\Db;

class Get extends Db {
  public function execute($sql, $values = array()) {
    if ($values) 

    try {
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute($values);

      return $stmt->FETCHALL(\PDO::FETCH_CLASS);

    } catch (\PDOException $e) {
      $this->debug($e->getMessage());
    }
  }
}
