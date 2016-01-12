<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Db;

/**
 * mysqlからPOST
 *
 * @package Db
 */
class Post extends Db
{

    /** @var Integer $lastInsertId 最後のid */
    private $lastInsertId;

    /**
     * sqlを実行
     *
     * @param String $sql
     * @param Array $values
     */
    public function execute($sql, $values = null)
    {
        try {
            $stmt = $this->dbh->prepare($sql);

            $stmt->execute((Array)$values);

            $this->lastInsertId = $this->dbh->lastInsertId();

            $res = $stmt->rowCount();

        } catch (\PDOException $e) {
            // @codeCoverageIgnoreStart
            echo  $this->debug($e->getMessage());
            // @codeCoverageIgnoreEnd
        }

        return $res;
    }

    /**
     * lastInsertIdを返す
     *
     * @param String $sql
     * @param Array $values
     * @return Integer
     */
    public function getLastInsertId()
    {
        return (Int)$this->lastInsertId;
    }
}
