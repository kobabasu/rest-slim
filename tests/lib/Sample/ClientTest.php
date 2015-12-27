<?php
namespace Lib\Sample;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-12-24 at 22:38:17.
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $service = $this->getMock(
            'Lib\Sample\ServiceInterface',
            array('say')
        );
        $service->expects($this->any())
          ->method('say')
          ->with($this->equalTo('tes'))
          ->will($this->returnValue('nayn'));

        $this->object = new Client($service);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Lib\Sample\Client::say
     * @test   testSay().
     */
    public function testSay()
    {
        $res = $this->object->say('tes');
        $this->assertEquals('nayn', $res);
    }
}
