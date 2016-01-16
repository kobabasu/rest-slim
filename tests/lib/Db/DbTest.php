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
class DbTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp()
    {
        $pdo = new Connect(
            '127.0.0.1',
            'api',
            'api',
            'api012',
            '3306',
            true
        );

        $res = $pdo->getConnection();
        $stub = $this->getMockFOrAbstractClass(
            '\Lib\Db\Db',
            array(
                $res,
                true
            )
        );

        $this->object = $stub;
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
        $res = $this->object->close();
        $this->assertNull($res);
    }

    /**
     * debugがtrueであればExceptionを返すか
     *
     * @covers Lib\Db\Db::debug()
     * @test testDebug()
     */
    public function testDebug()
    {
        $e = 'fail';
        $ref = new \ReflectionClass($this->object);
        $method = $ref->getMethod('debug');
        $method->setAccessible(true);
        $res = $method->invokeArgs(
            $this->object,
            array('fail')
        );
        $this->assertEquals('fail', $res);
    }
}
