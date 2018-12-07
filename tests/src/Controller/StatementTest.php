<?php
/**
  * StatementTest
  *
  *
  * @package    CapitalsObi
  * @subpackage benevsTest
  * @author     Obi Merenu <obinna@CapitalsObiedge.com>
  */
 namespace CapitalsObi\benevsTest\src\Controller;

 use Slim\Http\Environment;
 use Slim\Http\Request;
 use CapitalsObi\benevsTest\BaseTest;
 use CapitalsObi\benevsAPI\Helpers\RoutesInterfaceTest;

class StatementTest extends BaseTest implements RoutesInterfaceTest
{
    private $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1MjYzOTU1MjUsImp0aSI6ImYrajk3eFhMMCtcLzlROHpNOUI5NnVmWHBodFJkYnJ0MXdGTVhzd2s0SjdZPSIsIm5iZiI6MTUyNjM5NTUyNSwiZXhwIjoxNTI3MjU5NTI1LCJkYXRhIjp7InVzZXJJZCI6ImVtcHR5IiwidXNlcm5hbWUiOiJramFjb2JlcjgwNTIifX0.HVuugJvugxTbmBJY7iVqXrHhhpZgIdMQZcHzqcUQ63o';

    /**
     * Test statements route.
     */
    public function test_GetAll() {
        $_key = 1;
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            // 'CONTENT_TYPE'   => 'application/json;charset=utf8',
            'REQUEST_URI'    => '/api/'.A_VERSION.'/statements',
            ]);
        $req = Request::createFromEnvironment($env);

        $this->app->getContainer()['request'] = $req;
        $response = $this->app->run(true);
        $result_array = json_decode($response->getBody(), true);
        $this->assertTrue($req->isGet());
        $this->assertSame($response->getStatusCode(), 200);
        $this->assertArrayHasKey('S_ID', $result_array[$_key]);
        $this->assertArrayHasKey('USER_NAME', $result_array[$_key]);
    }

    public function test_GetOne() {
        $id = 2;
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'CONTENT_TYPE'   => 'application/x-www-form-urlencoded',
            'REQUEST_URI'    => '/api/'.A_VERSION.'/statement/'.$id ,
            'HTTP_AUTHORIZATION'    => $this->token,
            ]);

        $req = Request::createFromEnvironment($env);

        $this->app->getContainer()['request'] = $req;
        $response = $this->app->run(true);
        $result = json_decode($response->getBody(), true);
        $this->assertTrue($req->isGet());
        $this->assertSame($response->getStatusCode(), 200);
        $this->assertSame( $result["USE_CMP_NAME"], "N");
        $this->assertContains( 'EF_NUMBER":"50002', (string)$response->getBody());
    }

    public function test_Add() {
        $env = Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'CONTENT_TYPE'   => 'application/x-www-form-urlencoded',
            'REQUEST_URI'    => '/api/'.A_VERSION.'/statement/add' ,
            'HTTP_AUTHORIZATION'    => $this->token,
            ]);

        $req = Request::createFromEnvironment($env);

        $this->app->getContainer()['request'] = $req;
        $response = $this->app->run(true);
        $result = json_decode($response->getBody(), true);
        $this->assertTrue($req->isPost());
        $this->assertSame($response->getStatusCode(), 200);
    }

    public function test_Update() {
        $id = 2;
        $env = Environment::mock([
            'REQUEST_METHOD' => 'PUT',
            // 'CONTENT_TYPE'   => 'application/x-www-form-urlencoded',
            'REQUEST_URI'    => '/api/'.A_VERSION.'/statement/update/'.$id,
            'HTTP_AUTHORIZATION'    => $this->token,
            ]);

        $req = Request::createFromEnvironment($env);

        $this->app->getContainer()['request'] = $req;
        $response = $this->app->run(true);
        $result = json_decode($response->getBody(), true);

        $this->assertTrue($req->isPut());
        $this->assertSame($response->getStatusCode(), 200);
    }

    public function test_Delete() {
        $id = 1;
        $env = Environment::mock([
            'REQUEST_METHOD' => 'DELETE',
            // 'CONTENT_TYPE'   => 'application/x-www-form-urlencoded',
            'REQUEST_URI'    => '/api/'.A_VERSION.'/statement/delete/'.$id,
            'HTTP_AUTHORIZATION'    => $this->token,
            ]);

        $req = Request::createFromEnvironment($env);

        $this->app->getContainer()['request'] = $req;
        $response = $this->app->run(true);
        $result = json_decode($response->getBody(), true);

        $this->assertTrue($req->isDelete());
        $this->assertSame($response->getStatusCode(), 200);
    }

}
