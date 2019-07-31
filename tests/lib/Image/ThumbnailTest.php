<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\Image;

use \PHPUnit\Framework\TestCase;

/**
 * Thumbnailクラス用のテストファイル
 *
 * @package Image
 */
class ThumbnailTest extends TestCase
{
    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->object = new Thumbnail();
    }

    /**
     * @ignore
     */
    protected function tearDown(): void
    {
    }

    /**
     * @ignore
     */
    public static function tearDownAfterClass(): void
    {
        // for testSaveNormal
        
        if (is_file('./test_s.jpg')) {
            unlink('./test_s.jpg');
        }
    }

    /**
     * 正常系 $widthが正しく設定されるか
     *
     * @covers Lib\Image\Thumbnail::setWidth()
     * @test testSetWidthNormal()
     */
    public function testSetWidthNormal()
    {
        $class = new \ReflectionClass($this->object);
        $ref = $class->getProperty('width');
        $ref->setAccessible(true);
        $this->object->setWidth('500');
        $res = $ref->getValue($this->object);

        $this->assertEquals(500, $res);
    }

    /**
     * 正常系 $heightが正しく設定されるか
     *
     * @covers Lib\Image\Thumbnail::setHeight()
     * @test testSetHeightNormal()
     */
    public function testSetHeightNormal()
    {
        $class = new \ReflectionClass($this->object);
        $ref = $class->getProperty('height');
        $ref->setAccessible(true);
        $this->object->setHeight('500');
        $res = $ref->getValue($this->object);

        $this->assertEquals(500, $res);
    }

    /**
     * 正常系 サイズが小さくなっているか
     *
     * @covers Lib\Image\Thumbnail::copy()
     * @test testCopyNormal()
     */
    public function testCopyNormal()
    {
        $this->object->source('tests/imgs/test.jpg');
        $class = new \ReflectionClass($this->object);
        $method = $class->getMethod('copy');
        $method->setAccessible(true);
        $method->invokeArgs(
            $this->object,
            array()
        );
        $ref = $class->getProperty('canvas');
        $ref->setAccessible(true);

        $canvas = $ref->getValue($this->object);
        $res = imagesx($canvas);

        $this->assertEquals(224, $res);
    }

    /**
     * 正常系 save後にきちんとcanvasのメモリが開放されるか
     *
     * @covers Lib\Image\Thumbnail::save()
     * @test testSaveNormal()
     */
    public function testSaveNormal()
    {
        $this->object->source('tests/imgs/test.jpg');
        $this->object->setFilename('test');
        $class = new \ReflectionClass($this->object);
        $this->object->save();
        $ref = $class->getProperty('canvas');
        $ref->setAccessible(true);
        $canvas = $ref->getValue($this->object);
        $res = get_resource_type($canvas);

        $this->assertEquals('Unknown', $res);
    }
}
