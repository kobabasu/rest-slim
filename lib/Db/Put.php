<?php
namespace lib\Db;

class Put extends Db {
  public function execute($sql, $values = array()) {
    if (!is_array($values)) $values = array($values);

    try {
    } catch (PDOException $e) {
      $this->debug($e->getMessage());
    }
  }
}
