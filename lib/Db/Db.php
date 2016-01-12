<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Db;

/**
 * GET,POST,PUT,DELETEのスケルトンクラス
 *
 * @package Db
 */
abstract class Db
{
    /** @var Boolean $debug デバッグ状態 */
    protected $debug = false;

    /** @var Object $dbh DBハンドラー */
    protected $dbh;

    /**
     * 引数を代入
     *
     * @param Object $connection
     * @param Boolean $debug
     * @return void
     * @codeCoverageIgnore
     */
    public function __construct(
        \PDO $connection,
        $debug = false
    ) {
        $this->dbh = $connection;
        $this->debug = $debug;
    }

    /**
     * $dbhを空に
     *
     * @return null
     */
    public function close()
    {
        $this->dbh = null;
        return $this->dbh;
    }

    /**
     * $debugがtrueであれば表示
     *
     * @param String $e
     * @return void
     * @codeCoverageIgnore
     * @todo 閉じカッコがcoverできない
     */
    protected function debug($e)
    {
        if ($this->debug) {
            return $e;
        }
    }

    /**
     * $debugがtrueであれば表示
     *
     * @param String $sql
     * @param Array $values
     * @return void
     */
    abstract public function execute($sql, $values);
}
