<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Hello;

/**
 * Helloクラス用のテストファイル
 *
 * @package Hello
 */
class HelloTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Object object
     */
    protected $object;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = new Hello;
    }

    /**
     * @ignore
     */
    protected function tearDown()
    {
    }

    /**
     * @ignore
     *
     * @covers Lib\Hello\Hello::__construct
     * @test   testConstruct().
     */
    public function testConstruct()
    {
    }

    /**
     * sayメソッドが正しい値を返すか確認
     *
     * @covers Lib\Hello\Hello::say
     * @test   testSay().
     */
    public function testSay()
    {
        $res = $this->object->say();

        $this->assertEquals('Hello!', $res);
    }
}
