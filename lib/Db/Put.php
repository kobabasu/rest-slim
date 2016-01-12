<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Db;

/**
 * mysqlからPUT
 *
 * @package Db
 */
class Put extends Db
{
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

            $res = $stmt->rowCount();

        } catch (PDOException $e) {
            // @codeCoverageIgnoreStart
            echo $this->debug($e->getMessage());
            // @codeCoverageIgnoreEnd
        }

        return $res;
    }
}
