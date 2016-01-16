<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\SwiftMailer;

/**
 * Initクラス用のテストファイル
 *
 * @package SwiftMailer
 */
class InitTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = new \Lib\SwiftMailer\Init(
            '127.0.0.1',
            '1025',
            null,
            null
        );
    }

    /**
     * @ignore
     */
    protected function tearDown()
    {
    }

    /**
     * 変更したパスを返すか[
     *
     * @covers Lib\SwiftMailer\Init::setPath()
     * @test testSetPath()
     */
    public function testSetPath()
    {
        $this->object->setPath('dir', 'testfilename');
        $res = $this->object->getPath();
        $ans = 'dir/testfilename.log';
        $this->assertEquals($ans, $res);
    }

    /**
     * デフォルトのpathを返すか
     *
     * @covers Lib\SwiftMailer\Init::getPath()
     * @test testGetPath()
     */
    public function testGetPath()
    {
        $res = $this->object->getPath();
        $ans = 'logs/mail/' . date('ymd') .  '.log';
        $this->assertEquals($ans, $res);
    }

    /**
     * ログファイルが生成されるか
     *
     * @covers Lib\SwiftMailer\Init::saveLog()
     * @test testSaveLog()
     */
    public function testSaveLog()
    {
        $mailer = $this->object->getMailer();
        $this->object->saveLog();
        $file = $this->object->getPath();
        $this->assertFileExists($file);
    }
}
