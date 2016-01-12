<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Db;

/**
 * PDOのシングルトンを実現
 *
 * @package Db
 */
class Connect
{
    /*
     * インスタンス
     *
     * @param PDO $pdo
     * @return object
     */
    private static $instance;

    /*
     * シングルトン
     *
     * @param PDO $pdo
     * @return object
     */
    public static function getInstance(\PDO $pdo)
    {
        if (!self::$instance) {
            self::$instance = new self($pdo);
        }

        return self::$instance;
    }

    /*
     * instanceに代入
     *
     * @param PDO $pdo
     * @return vold
     */
    private function __construct(\PDO $pdo)
    {
        $this->instance = $pdo;
    }

    /*
     * 複製を禁止
     *
     * @return vold
     */
    final public function __clone()
    {
        //no op
    }

    /*
     * インスタンスを返す
     *
     * @return object
     */
    public function getConnection()
    {
        return $this->instance;
    }
}
