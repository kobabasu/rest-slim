<?php
namespace Lib\Db;

class Delete extends Db {
  public function execute($sql, $values = array()) {
    if(!is_array($values)) $values = array($values);

    try {
      $stmt = $this->dbh->prepare($sql);

      $stmt->execute($values);

      return $stmt->rowCount();

    } catch (PDOException $e) {
      $this->debug($e->getMessage());
    }
  }
}
