<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Slim;

use Lib\Legacy\JsonEncode;

/**
 * Helloクラス用のテストファイル
 *
 * @package Slim
 */
class SlimExtendsTest extends \PHPUnit_Framework_TestCase
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
        $this->object = new SlimExtends;
    }

    /**
     * @ignore
     */
    protected function tearDown()
    {
    }

    /**
     * '日本語'をjsonの'日本語'と返すか
     *
     * @covers Lib\Slim\SlimExtends::renderJSON()
     * @test testRenderJSON()
     */
    public function testRenderJSON()
    {
        $data = array('a' => '日本語');
        $res = $this->object->renderJSON($data);
        $this->assertEquals('{"a":"日本語"}', $res);
    }

    /**
     * php5.3で'日本語'をjsonの'日本語'と返すか
     *
     * @covers Lib\Slim\SlimExtends::renderJSON()
     * @test testRenderJSON53()
     */
    public function testRenderJSON53()
    {
        $data = array('a' => '日本語');
        $res = $this->object->renderJSON($data, false, 3);
        $this->assertEquals('{"a":"日本語"}', $res);
    }

    /**
     * debugがtrueでprettyPrintで返すか
     *
     * @covers Lib\Slim\SlimExtends::renderJSON()
     * @test testRenderJSONDebug()
     */
    public function testRenderJSONDebug()
    {
        $data = array('a' => '日');
        $res = $this->object->renderJSON($data, true);
        $ans = '{'.PHP_EOL.'  "a":"日"'.PHP_EOL.'}';
        $this->assertEquals($ans, $res);
    }

    /**
     * php5.3でprettyPrintで返すか
     *
     * @covers Lib\Slim\SlimExtends::convertPrettyPrint()
     * @test testConvertPrettyPrint()
     */
    public function testConvertPrettyPrint()
    {
        $data = json_encode(array('a' => '日'));
        $res = $this->object->convertPrettyPrint($data, 3);
        $ans = '{'.PHP_EOL.'  "a":"\u65e5"'.PHP_EOL.'}';
        $this->assertEquals($ans, $res);
    }

    /**
     * '日本語'をsjisの'日本語'と返すか
     *
     * @covers Lib\Slim\SlimExtends::renderCSV()
     * @test testRenderCSV()
     */
    public function testRenderCSV()
    {
        $data = array('a' => '日本語');
        $res = $this->object->renderCSV($data);
        $ans = "日本語" . PHP_EOL;
        $ans = mb_convert_encoding($ans, "SJIS", "UTF-8");
        $this->assertEquals($ans, $res);
    }
}
