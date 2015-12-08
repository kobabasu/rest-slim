<?php
namespace lib\Db;

class Put extends Db {
  public function execute($sql, $values = array()) {
    try {
    } catch (PDOException $e) {
      $this->debug($e->getMessage());
    }
  }
}
