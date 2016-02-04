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

/**
 * Slimの拡張
 *
 * @package Routes
 */
class AppMock extends \PHPUnit_Framework_TestCase
{

    protected $app;
    protected $response;
    protected $request;

    /**
     * dispatch
     *
     * @codeCoverageIgnore
     */
    protected function dispatch(
        $path,
        $method = 'GET',
        $data = array()
    ) {
        $app = new App();
        $this->app = $app;

        $env = Environment::mock([
            'REQUEST_URI' => $path,
            'REQUEST_METHOD' => $method
        ]);

        $uri = Uri::createFromEnvironment($env);
        $headers = Headers::createFromEnvironment($env);
        $cookies = [];
        $serverParams = $env->all();
        $body = new RequestBody();

        $this->request = new Request(
            $method,
            $uri,
            $headers,
            $cookies,
            $serverParams,
            $body
        );

        $this->response = new Response();

        // $this->assertInstanceOf(
        //     '\Psr\Http\Message\ResponseInterface',
        //     $resOut
        // );
    }
}
