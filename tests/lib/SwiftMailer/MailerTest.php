<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Lib\SwiftMailer;

/**
 * Mailerクラス用のテストファイル
 *
 * @package SwiftMailer
 */
class MailerTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp()
    {
        $swift = new \Lib\SwiftMailer\Init(
            '127.0.0.1',
            '1025',
            null,
            null
        );

        $this->object = new Mailer($swift);
    }

    /**
     * @ignore
     */
    protected function tearDown()
    {
    }

    /**
     * テンプレートを返すか
     *
     * @covers Lib\SwiftMailer\Mailer::setTemplate()
     * @test testSetTemplate()
     */
    public function testSetTemplate()
    {
        $res = $this->object->setTemplate(
            'defaultTest.twig',
            array('name' => 'twig')
        );

        $this->assertEquals('Hello twig' . PHP_EOL, $res);
    }

    /**
     * メッセージを返すか
     *
     * @covers Lib\SwiftMailer\Mailer::setMessage()
     * @test testSetMessage()
     */
    public function testSetMessage()
    {
        $body = $this->object->setTemplate(
            'defaultTest.twig',
            array('name' => '太郎')
        );

        $res = $this->object->setMessage(
            'test subject',
            array('test@example.com' => 'テスト担当'),
            $body
        );

        $this->assertInternalType('object', $res);
    }

    /**
     * メッセージを返すか
     *
     * @covers Lib\SwiftMailer\Mailer::send()
     * @test testSetSend()
     */
    public function testSend()
    {
        $body = $this->object->setTemplate(
            'defaultTest.twig',
            array('name' => '太郎')
        );

        $this->object->setMessage(
            'タイトル',
            array('admin@example.com' => 'テスト担当'),
            $body
        );

        $res = $this->object->send(
            'test@example.com'
        );

        $this->assertEquals(1, $res);
    }
}