<?php
namespace Lib\Slim;

class Render extends Extend {

  public function json($data) {
    if ($this->debug) {
      $json = $this->legacyStr->json_xencode($data);
      $res = $this->legacyStr->prettyPrint($json);
    } else {
      $res = json_encode($data);
    }

    return $this->app->response->setBody($res);
  }
}
