<?php
namespace Lib\Slim;

class Render extends Extend {

  public function json($data) {
    if ($this->debug) {
      $res = json_encode($data);
    } else {
      $res = json_encode($data);
    }

    return $this->app->response->setBody($res);
  }
}
