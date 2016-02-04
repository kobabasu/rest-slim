<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Routes;

/**
 * Dbクラス用のテストファイル
 *
 * @package Routes
 */
class IndexTest extends AppMock
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
    }

    /**
     * @ignore
     */
    protected function tearDown()
    {
    }

    /**
     * 正常系 '/'のgetがHelloと返すか
     *
     * @test testIndexzGetNormal()
     */
    public function testIndexGetNormal()
    {
        $this->dispatch('/');

        $app = $this->app;

        require 'routes/index.php';

        $resOut = $app($this->request, $this->response);

        $this->assertEquals(
            'hello',
            $resOut->getBody()
        );
    }

    /**
     * 正常系 '/'のgetのContent-Typeがtext/htmlか
     *
     * @test testIndexzGetContentTypeNormal()
     */
    public function testIndexGetContentTypeNormal()
    {
        $this->dispatch('/');

        $app = $this->app;

        require 'routes/index.php';

        $resOut = $app($this->request, $this->response);

        $this->assertEquals(
            'text/html',
            $resOut->getHeader('Content-Type')[0]
        );
    }
}
