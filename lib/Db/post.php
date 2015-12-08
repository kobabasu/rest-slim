<?php
namespace Lib\Db;

class Post extends Db {
  public function exec($sql, $values = array()) {
    try {
      $stmt = $this->_dbh->prepare($sql);
      $stmt->execute($values);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}
