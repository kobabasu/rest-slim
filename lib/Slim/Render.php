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

  public function csv($data) {
    $date = date("Ymd_His");
    $file = $this->app->model . '.' . $date . '.csv';

    $this->app->response->headers->set(
      'Content-Type', 'application/octet-stream'
    );
    $this->app->response->headers->set(
      'Content-Disposition', 'attachment; filename=' . $file
    );

    $fp = fopen('php://memory', 'r+');
    foreach ($data as $row) fputcsv($fp, (Array)$row);
    rewind($fp);
    $raw = stream_get_contents($fp);
    $csv = mb_convert_encoding($raw, "SJIS", "UTF-8");
    fclose($fp);

    $this->app->response->setBody($csv);
  }
}
