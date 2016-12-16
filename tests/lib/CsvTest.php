<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Common;

/**
 * Validateクラス用のテストファイル
 *
 * @package Common
 */
class CsvTest extends \PHPUnit_Framework_TestCase
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
        parent::setUp();

        $headers = array('debug');
        $this->object = new Csv($headers);
    }

    /**
     * @ignore
     */
    protected function tearDown()
    {
    }

    /**
     * 正常系 $pathが正しく設定されるか
     *
     * @covers Lib\Common\Csv::setPath()
     * @test testSetPathNormal()
     */
    public function testSetPathNormal()
    {
        $class = new \ReflectionClass($this->object);
        $ref = $class->getProperty('path');
        $ref->setAccessible(true);

        $this->object->setPath('debug');
        $res = $ref->getValue($this->object);

        $this->assertEquals('debug', $res);
    }

    /**
     * 正常系 $pathが正しく返せるか
     *
     * @covers Lib\Common\Csv::getPath()
     * @test testGetPathNormal()
     */
    public function testGetPathNormal()
    {
        $this->object->setPath('debug');
        $res = $this->object->getPath();

        $this->assertEquals('debug', $res);
    }

    /**
     * 正常系 $headersが正しく設定されるか
     *
     * @covers Lib\Common\Csv::setHeaders()
     * @test testSetHeadersNormal()
     */
    public function testSetHeadersNormal()
    {
        $class = new \ReflectionClass($this->object);
        $ref = $class->getProperty('headers');
        $ref->setAccessible(true);

        $headers = array('debug');
        $this->object->setHeaders($headers);
        $res = $ref->getValue($this->object);

        $this->assertEquals("debug\r\n", $res);
    }

    /**
     * 正常系 $disableがtrueとなるか
     *
     * @covers Lib\Common\Csv::disableHeader()
     * @test testSetDisableHeaderNormal()
     */
    public function testSetDisableHeaderNormal()
    {
        $class = new \ReflectionClass($this->object);
        $ref = $class->getProperty('disable');
        $ref->setAccessible(true);

        $this->object->disableHeader();
        $res = $ref->getValue($this->object);

        $this->assertTrue($res);
    }

    /**
     * 正常系 $disableがtrueでヘッダが追加されないか
     *
     * @covers Lib\Common\Csv::disableHeader()
     * @test testSetDisableHeaderCheckNormal()
     */
    public function testSetDisableHeaderCheckNormal()
    {
        $rows = array(
            array('body1', 'body2')
        );
        $this->object->disableHeader();
        $res = $this->object->setBody($rows);

        $str = "body1, body2\r\n";
        $this->assertEquals($str, $res);
    }

    /**
     * 正常系 $bodyが正しく設定されるか
     *
     * @covers Lib\Common\Csv::setBody()
     * @test testSetBodyNormal()
     */
    public function testSetBodyNormal()
    {
        $rows = array(
            array('body1', 'body2')
        );
        $res = $this->object->setBody($rows);

        $str = "debug\r\nbody1, body2\r\n";
        $this->assertEquals($str, $res);
    }

    /**
     * 正常系 正しく保存されるか
     *
     * @covers Lib\Common\Csv::save()
     * @test testSaveNormal()
     */
    public function testSaveNormal()
    {
        $filename = 'test';
        $this->object->save($filename);

        $path = $this->object->getPath();
        $file = $path . $filename . '.csv';

        $res = file_exists($file);

        $this->assertTrue($res);

        unlink($file);
    }
}
