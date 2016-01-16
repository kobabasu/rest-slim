<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Slim;

use \Slim\Slim;
use Lib\Legacy\JsonEncode;

/**
 * Slim拡張
 *
 * @package Slim
 */
class SlimExtends extends Slim
{
    /**
     * JSONで出力する
     *
     * @param Array $data
     * @param Boolean $debug
     * @param Int $version
     * @return String
     */
    public function renderJSON(
        $data,
        $debug = false,
        $version = null
    ) {
        if (is_null($version)) {
            $version = PHP_MINOR_VERSION;
        }

        if ($version > 3) {
            $res = json_encode(
                $data,
                JSON_UNESCAPED_UNICODE
            );
        } else {
            $res = JsonEncode::jsonXencode($data);
        }

        if ($debug) {
            $res = $this->convertPrettyPrint($res);
        }

        $this->response->setBody($res);

        return $res;
    }

    /**
     * PrettyPrintで変換する
     *
     * @param String $data
     * @return String
     */
    public function convertPrettyPrint($data)
    {
        return JsonEncode::prettyPrint($data);
    }

    /**
     * CSVで出力する
     *
     * @param Array $data
     * @return String
     */
    public function renderCSV($data)
    {
        $date = date("Ymd_His");
        $file = $this->model . '.' . $date . '.csv';

        $this->response->headers->set(
            'Content-Type',
            'application/octet-stream'
        );
        $this->response->headers->set(
            'Content-Disposition',
            'attachment; filename=' . $file
        );

        $fp = fopen('php://memory', 'r+');
        foreach ($data as $row) {
            fputcsv($fp, (Array)$row);
        }
        rewind($fp);
        $raw = stream_get_contents($fp);
        $csv = mb_convert_encoding($raw, "SJIS", "UTF-8");
        fclose($fp);

        $this->response->setBody($csv);

        return $csv;
    }
}
