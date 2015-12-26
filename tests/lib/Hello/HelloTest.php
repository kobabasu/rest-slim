<?php
namespace Lib\Hello;

class HelloTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Hello
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new Hello;
    }

    protected function tearDown()
    {
    }

    /**
     * @covers Lib\Sample\Client::say
     * @test   testSay().
     */
    public function testSay()
    {
      $res = $this->object->say();
      $this->assertEquals('Hello', $res);
    }
}
