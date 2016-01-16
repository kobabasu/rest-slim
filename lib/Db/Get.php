<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Db;

/**
 * mysqlからFETCHALL
 *
 * @package Db
 */
class Get extends Db
{
    /**
     * sqlを実行
     *
     * @param String $sql
     * @param Array $values
     * @return Object
     */
    public function execute($sql, $values = null)
    {
        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute((Array)$values);

            $res =  $stmt->FETCHALL(\PDO::FETCH_CLASS);

        } catch (\PDOException $e) {
            // @codeCoverageIgnoreStart
            echo $this->debug($e->getMessage());
            // @codeCoverageIgnoreEnd
        }

        return $res;
    }
}
