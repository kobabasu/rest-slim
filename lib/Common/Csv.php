<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Common;

/**
 * 汎用的なライブラリ
 *
 * @package Common
 */
class Csv
{
    /** @var String $header CSVのヘッダ */
    private $headers = null;

    /** @var String $body CSVのボディ */
    private $body = null;

    /** @var String $body CSVのボディ */
    private $path = './';

    /** @var Boolean $disable ヘッダを表示させない */
    private $disable = false;

    /**
     * Objectを作成
     *
     * @param Array $headers
     * @return void
     * @codeCoverageIgnore
     */
    public function __construct(
        $headers
    ) {
        $this->setHeaders($headers);
    }

    /**
     * 保存するパスを設定
     *
     * @param Array $path
     * @return void
     */
    public function setPath($path)
    {
        return $this->path = $path;
    }

    /**
     * 保存するパスを返す
     *
     * @return void
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * ヘッダを設定
     *
     * @param Array $headers
     * @return void
     */
    public function setHeaders($headers)
    {
        $header  = implode(', ', $headers);
        $header .= "\r\n";

        $this->headers = $header;
    }

    /**
     * ヘッダを非表示にする
     *
     * @return void
     */
    public function disableHeader()
    {
        $this->disable = true;
    }

    /**
     * 実際にレコードをボディとして挿入
     *
     * @param array $rows
     * @return vold
     */
    public function setBody($rows)
    {
        $res = null;
        if (!$this->disable) {
            $res = $this->headers;
        }

        foreach ($rows as $row) {
            $res .= implode(', ', $row);
            $res .= "\r\n";
        }

        $this->body = $res;

        $res = $this->convertEnc($res);

        return $res;
    }

    /**
     * sjis-winに変換し保存
     *
     * @param array $rows
     * @return vold
     */
    public function save($filename)
    {
        $file = $this->path . $filename . '.csv';

        $body = $this->convertEnc($this->body);

        $fp = fopen($file, 'w');
        flock($fp, LOCK_EX);
        fwrite($fp, $body);
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    private function convertEnc($body)
    {
        return mb_convert_encoding(
            $body,
            "sjis-win",
            "UTF-8"
        );
    }
}
