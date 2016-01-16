<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Sample;

/**
 * Lib\Sample\Clientのテスト
 *
 * @package Sample
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * テスト用オブジェクト
     *
     * @var Client
     */
    protected $object;

    /**
     * setUp method
     *
     * @return void
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
     * @ignore
     */
    protected function tearDown()
    {
    }

    /**
     * 正しい文字列を返すか
     *
     * @covers Lib\Sample\Client::__construct
     * @test   Implement testConstruct().
     */
    public function testConstruct()
    {
        $this->assertNotNull($this->object);
    }

    /**
     * 正しい文字列を返すか
     *
     * @covers Lib\Sample\Client::say
     * @test   testSay().
     */
    public function testSay()
    {
        $res = $this->object->say('tes');
        $this->assertEquals('nayn', $res);
    }
}
