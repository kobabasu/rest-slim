<?php
namespace Lib\Db;

class Put extends Db {
  public function execute($sql, $values = array()) {
    if (!is_array($values)) $values = array($values);

    try {
      $stmt = $this->dbh->prepare($sql);

      return $stmt->execute($values);

    } catch (PDOException $e) {
      $this->debug($e->getMessage());
    }
  }
}
