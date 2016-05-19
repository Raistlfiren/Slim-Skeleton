<?php

namespace App\TestUtility;

use Slim\App;
use Slim\Http\Environment;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\RequestBody;
use Slim\Http\Response;
use Slim\Http\UploadedFile;
use Slim\Http\Uri;
use PHPUnit_Framework_TestCase;
use App\Loader\Kernel;

abstract class AbstractTestFunctional extends PHPUnit_Framework_TestCase
{
    /** @var App $app */
    protected $app;

    /** @var Request $request */
    protected $request;

    /** @var Response $response */
    protected $response;

    public function setUp()
    {
        $app = new App();

        $kernel = new Kernel($app, $app->getContainer());
        $kernel->registerServices();
        $kernel->registerRoutes();

        $this->app = $app;
    }

    public function setupRequest($url, $method, $request, $files)
    {
        $env = Environment::mock([
            'REQUEST_URI' => $url,
            'REQUEST_METHOD' => $method,
            'HTTP_CONTENT_TYPE' => 'multipart/form-data; boundary=---foo'
        ]);
        $uri = Uri::createFromEnvironment($env);
        $headers = Headers::createFromEnvironment($env);
        $files = UploadedFile::createFromEnvironment(Environment::mock());
        $cookies = [];
        $serverParams = $env->all();
        $body = new RequestBody();
        $this->request = new Request($method, $uri, $headers, $cookies, $serverParams, $body, $files);

        $this->response = new Response();

        $app = $this->app;

        return $app($this->request, $this->response);
    }

    public function get($url)
    {
        return $this->setupRequest($url, 'GET', null, null);
    }

    public function post($url, $request, $files)
    {
        return $this->setupRequest($url, 'POST', $request, $files);
    }
}
