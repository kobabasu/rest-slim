<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Db;

/**
 * Connectクラス用のテストファイル
 *
 * @package Db
 */
class ConnectTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp()
    {
    }

    /**
     * @ignore
     */
    protected function tearDown()
    {
    }

    /**
     * debugがtrueであればExceptionを返すか
     *
     * @covers Lib\Db\Connect::getConnection()
     * @test testGetConnectionTrue()
     */
    public function testGetConnectionTrue()
    {
        try {
            $pdo = new Connect(
                '127.0.0.1',
                'api',
                'api',
                'api012',
                '3306',
                true
            );

            $res = $pdo->getConnection();
            $this->fail('fail');
        } catch (\Exception $c) {
            $this->assertEquals(
                'fail',
                $c->getMessage()
            );
        }
    }

    /**
     * debugがfalseであればExceptionを返せないか
     *
     * @covers Lib\Db\Connect::getConnection()
     * @test testGetConnectionFalse()
     */
    public function testGetConnectionFalse()
    {
        try {
            $pdo = new Connect(
                '127.0.0.1',
                'api',
                'api',
                'api0123',
                '3306',
                false
            );

            $res = $pdo->getConnection();
            $this->fail('fail');
        } catch (\Exception $e) {
            $this->assertNull($res);
        }
    }
}
