<?php
/**
 * Helloクラス用のテストファイル
 */

namespace Lib\Hello;

/**
 * Helloクラス用のテストファイル
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
     * sayメソッドが正しい値を返すか確認
     *
     * @covers Lib\Sample\Client::say
     * @test   testSay().
     */
    public function testSay()
    {
        $res = $this->object->say();

        $this->assertEquals('Hello!', $res);
    }
}
