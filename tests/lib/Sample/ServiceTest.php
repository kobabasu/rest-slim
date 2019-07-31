<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Sample;

use \PHPUnit\Framework\TestCase;

/**
 * Lib\Sample\Serviceのテスト
 *
 * @package Sample
 */
class ServiceTest extends TestCase
{
    /** @var Object $object 対象クラス */
    protected $object;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->object = new Service;
    }

    /**
     * @ignore
     */
    protected function tearDown(): void
    {
    }

    /**
     * 正常系 正しい文字列を返すか
     *
     * @covers Lib\Sample\Service::say
     * @test   Implement testSayNormal()
     */
    public function testSayNormal()
    {
        $res = $this->object->say('tes');
        $this->assertEquals('service: tes' . PHP_EOL, $res);
    }
}
