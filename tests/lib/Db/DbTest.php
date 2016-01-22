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
        $dsn = 'mysql:host=0.0.0.0;dbname=api;';

        $this->pdo = new \PDO($dsn, 'api', 'api012');

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

        $mock = $this->getMockForAbstractClass(
            '\Lib\Db\Db',
            array(
                $this->pdo,
                true
            )
        );

        $this->object = $mock;
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
        $mock = $this->getMockForAbstractClass(
            '\Lib\Db\Db',
            array(
                $this->pdo,
                true
            )
        );

        $class = new \ReflectionClass($mock);
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
        $mock = $this->getMockForAbstractClass(
            '\Lib\Db\Db',
            array(
                $this->pdo,
                true
            )
        );

        $e = 'fail';
        $ref = new \ReflectionClass($mock);
        $method = $ref->getMethod('debug');
        $method->setAccessible(true);
        $res = $method->invokeArgs(
            $mock,
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
        $mock = $this->getMockForAbstractClass(
            '\Lib\Db\Db',
            array(
                $this->pdo,
                false
            )
        );

        $e = 'fail';
        $ref = new \ReflectionClass($mock);
        $method = $ref->getMethod('debug');
        $method->setAccessible(true);
        $res = $method->invokeArgs(
            $mock,
            array($e)
        );
        $this->assertNull($res);
    }
}
