<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Db;

/**
 * Dbクラス用のテストファイル
 *
 * @package Db
 */
class DbTest extends \PHPUnit_Extensions_Database_TestCase
{
    protected $pdo;
    protected $db;
    protected $object;

    public function getConnection()
    {
        $dsn  = "mysql:host={$GLOBALS['DB_HOST']};";
        $dsn .= "dbname={$GLOBALS['DB_NAME']};";
        $this->pdo = new \PDO(
            $dsn,
            $GLOBALS['DB_USER'],
            $GLOBALS['DB_PASS']
        );

        return $this->createDefaultDBConnection(
            $this->pdo,
            $dsn
        );
    }

    public function getDataSet()
    {
        return new \PHPUnit_Extensions_Database_DataSet_YamlDataSet(
            dirname(__FILE__) . '/../../fixtures/users.yml'
        );
    }

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->db = $this->getConnection();

        $this->object = $this->getObject();
    }

    /**
     * DBUnit拡張でDBのモックを作成
     *
     * @return Object
     */
    public function getObject()
    {
        $mock = $this->getMockForAbstractClass(
            '\Lib\Db\Db',
            array($this->pdo)
        );

        return $mock;
    }

    /**
     * @ignore
     */
    protected function tearDown()
    {
    }

    /**
     * nullを返すか
     *
     * @covers Lib\Db\Db::close()
     * @test testClose()
     */
    public function testClose()
    {
        $class = new \ReflectionClass($this->object);
        $ref = $class->getProperty('pdo');
        $ref->setAccessible(true);
        $this->object->close();
        $res = $ref->getValue($this->object);

        $this->assertNull($res);
    }

    /**
     * debugがtrueであればExceptionを返すか
     *
     * @covers Lib\Db\Db::debug()
     * @test testDebugTrue()
     */
    public function testDebugTrue()
    {
        $e = 'fail';
        $this->object->setDebug(true);
        $ref = new \ReflectionClass($this->object);
        $method = $ref->getMethod('debug');
        $method->setAccessible(true);
        $res = $method->invokeArgs(
            $this->object,
            array($e)
        );
        $this->assertEquals('fail', $res);
    }

    /**
     * debugがtrueであればExceptionを返すか
     *
     * @covers Lib\Db\Db::debug()
     * @test testDebugFalse()
     */
    public function testDebugFalse()
    {
        $e = 'fail';
        $this->object->setDebug(false);
        $ref = new \ReflectionClass($this->object);
        $method = $ref->getMethod('debug');
        $method->setAccessible(true);
        $res = $method->invokeArgs(
            $this->object,
            array($e)
        );
        $this->assertNull($res);
    }
}
