<?php
namespace lib\Db;

class Put extends Db {
  public function execute($sql, $array = array()) {
    try {
    } catch (PDOException $e) {
      $this->debug($e->getMessage());
    }
  }
}
