<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Slim;

use Lib\Legacy\JsonEncode;

/**
 * SlimExtendsクラス用のテストファイル
 *
 * @package Slim
 */
class SlimExtendsTest extends \PHPUnit_Framework_TestCase
{
    /** @var Object $object 対象クラス */
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
     * 正常系 '日本語'をjsonの'日本語'と返すか
     *
     * @covers Lib\Slim\SlimExtends::renderJSON()
     * @test testRenderJsonNormal()
     */
    public function testRenderJsonNormal()
    {
        $data = array('a' => '日本語');
        $res = $this->object->renderJson($data);
        $this->assertEquals('{"a":"日本語"}', $res);
    }

    /**
     * 正常系 php5.3で'日本語'をjsonの'日本語'と返すか
     *
     * @covers Lib\Slim\SlimExtends::renderJSON()
     * @test testRenderJson53Normal()
     */
    public function testRenderJson53Normal()
    {
        $data = array('a' => '日本語');
        $res = $this->object->renderJson($data, false, 3);
        $this->assertEquals('{"a":"日本語"}', $res);
    }

    /**
     * 正常系 debugがtrueでprettyPrintで返すか
     *
     * @covers Lib\Slim\SlimExtends::renderJSON()
     * @test testRenderJsonDebugNormal()
     */
    public function testRenderJsonDebugNormal()
    {
        $data = array('a' => '日');
        $res = $this->object->renderJson($data, true);
        $ans = '{'.PHP_EOL.'  "a":"日"'.PHP_EOL.'}';
        $this->assertEquals($ans, $res);
    }

    /**
     * 正常系 php5.3でprettyPrintで返すか
     *
     * @covers Lib\Slim\SlimExtends::convertPrettyPrint()
     * @test testConvertPrettyPrintNormal()
     */
    public function testConvertPrettyPrintNormal()
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
     * @test testRenderCsvNormal()
     */
    public function testRenderCsvNormal()
    {
        $data = array('a' => '日本語');
        $res = $this->object->renderCsv($data);
        $ans = "日本語" . PHP_EOL;
        $ans = mb_convert_encoding($ans, "SJIS", "UTF-8");
        $this->assertEquals($ans, $res);
    }
}
