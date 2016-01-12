<?php
namespace Lib\Db;

class Post extends Db {

  private $lastInsertId;

  public function execute($sql, $values = array()) {
    if (!is_array($values)) $values = array($values);
    
    try {
      $stmt = $this->dbh->prepare($sql);

      $stmt->execute($values);

      $this->lastInsertId = $this->dbh->lastInsertId();

      return $stmt->rowCount();

    } catch (PDOException $e) {
      $this->debug($e->getMessage());
    }
  }

  public function getLastInsertId() {
    return $this->lastInsertId;
  }
}
