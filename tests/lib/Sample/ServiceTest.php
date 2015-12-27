<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Sample;

/**
 * Lib\Sample\Serviceのテスト
 *
 * @package Sample
 */
class ServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * テスト用オブジェクト
     *
     * @var Service
     */
    protected $object;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = new Service;
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
     * @covers Lib\Sample\Service::say
     * @test   Implement testSay().
     */
    public function testSay()
    {
        $res = $this->object->say('tes');
        $this->assertEquals('service: tes' . PHP_EOL, $res);
    }
}
