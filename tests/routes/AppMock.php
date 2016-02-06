<?php
/**
 * Web App REST API
 *
 * @link https://github.com/kobabasu/rest-php.git
 */

namespace Routes;

use \Slim\App;
use \Slim\Http\Body;
use \Slim\Http\Environment;
use \Slim\Http\Headers;
use \Slim\Http\Request;
use \Slim\Http\RequestBody;
use \Slim\Http\Response;
use \Slim\Http\Uri;

use \Lib\Db\Get;
use \Lib\Db\Post;
use \Lib\Db\Put;
use \Lib\Db\Delete;

/**
 * Slimの拡張
 *
 * @package Routes
 */
class AppMock extends \PHPUnit_Extensions_Database_TestCase
{
    /** @var Object $pdo PDOオブジェクト */
    protected $pdo;

    /** @var Object $db getConnectionの返り値  */
    protected $db;

    /** @var Object $object 対象クラス */
    protected $object;

    /** @var Object $app Slimアプリケーション */
    protected $app;

    /** @var Object $body bodyオブジェクト */
    protected $body;

    /** @var Object $request requestオブジェクト */
    protected $request;

    /** @var Object $response responseオブジェクト */
    protected $response;

    /**
     * getConnection method
     *
     * @return Object
     */
    public function getConnection()
    {
        $dsn  = "mysql:host={$GLOBALS['DB_HOST']};";
        $dsn .= "dbname={$GLOBALS['DB_NAME']};";
        $this->pdo = new \PDO(
            $dsn,
            $GLOBALS['DB_USER'],
            $GLOBALS['DB_PASS']
        );

        return $this->createDefaultDBConnection(
            $this->pdo,
            $dsn
        );
    }

    /**
     * getDataSet method
     *
     * @return Object
     */
    public function getDataSet()
    {
        return new \PHPUnit_Extensions_Database_DataSet_YamlDataSet(
            dirname(__FILE__) . '/../fixtures/users.yml'
        );
    }

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->db = $this->getConnection();

        $this->object = $this->getObject();

        $this->body = new RequestBody();
    }

    /**
     * @ignore
     */
    protected function tearDown()
    {
    }

    /**
     * DBUnit拡張でDBのモックを作成
     *
     * @return Object
     */
    public function getObject()
    {
        $mock = $this->getMockForAbstractClass(
            '\Lib\Db\Db',
            array($this->pdo)
        );

        return $mock;
    }

    /**
     * SlimアプリケーションのMockを作成
     *
     * @param String $path アクセスするURI
     * @param String $method 使用するhttpメソッド
     * @return Object
     */
    protected function create(
        $path,
        $method = 'GET'
    ) {
        $this->app = new App();

        $env = Environment::mock([
            'REQUEST_URI' => $path,
            'REQUEST_METHOD' => $method
        ]);

        $uri = Uri::createFromEnvironment($env);
        //$headers = Headers::createFromEnvironment($env);
        $headers = new Headers([
            'Content-Type' => 'application/json;charset=utf8'
        ]);
        $cookies = [];
        $serverParams = $env->all();

        $this->request = new Request(
            $method,
            $uri,
            $headers,
            $cookies,
            $serverParams,
            $this->body
        );

        $this->setContainer($this->app->getContainer());

        $this->response = new Response();

        return $this->app;
    }

    /**
     * bodyを設定 POST, PUTなど
     *
     * @param String $body // 投げるJSON
     * @return void
     */
    protected function setRequestBody($body)
    {
        $this->body->write($body);
        $this->body->rewind();
    }

    /**
     * Slim appのインスタンスを作成し実行
     *
     * @param Object $app Slimのapp
     * @return void
     */
    protected function invoke($app)
    {
        return $app($this->request, $this->response);
    }

    /**
     * コンテナを追加
     *
     * @param Object $container コンテナオブジェクト
     * @return void
     */
    private function setContainer($container)
    {
        $container['db.get'] = function ($c) {
            $obj = new Get($this->pdo);
            $obj->setDebug(true);

            return $obj;
        };

        $container['db.post'] = function ($c) {
            $obj = new Post($this->pdo);
            $obj->setDebug(true);

            return $obj;
        };

        $container['db.put'] = function ($c) {
            $obj = new Put($this->pdo);
            $obj->setDebug(true);

            return $obj;
        };

        $container['db.delete'] = function ($c) {
            $obj = new Delete($this->pdo);
            $obj->setDebug(true);

            return $obj;
        };
    }
}
