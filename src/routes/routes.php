<?php
/**
  * Routes
  *
  * @package    CapitalsObi
  * @subpackage benevsAPI
  * @author     Obi Merenu <obinna@CapitalsObiedge.com>
  */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \CapitalsObi\benevsAPI\Middleware\AuthMiddleware;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->get('/', \HomeController::class.':home');

// generates token for secure endpoints
$app->post('/api/'.A_VERSION.'/auth/token', \AuthController::class.':login');

// Statement routes
$app->group('/api/'.A_VERSION, function () {
      $this->get('/statements', \StatementController::class.':getAll');

      $this->get('/statement/{id}', \StatementController::class.':getOne')->add( new AuthMiddleware());

      $this->post('/statement/add', \StatementController::class.':add')->add( new AuthMiddleware());

      $this->put('/statement/update/{id}', \StatementController::class.':update')->add( new AuthMiddleware());

      $this->delete('/statement/delete/{id}', \StatementController::class.':delete')->add( new AuthMiddleware());
});

// Customer routes
$app->group('/api/'.A_VERSION, function () {
      $this->get('/customers', \CustomerController::class.':getAll');

      $this->get('/customer/{id}', \CustomerController::class.':getOne')->add( new AuthMiddleware());

      $this->post('/customer/add', \CustomerController::class.':add')->add( new AuthMiddleware());

      $this->put('/customer/update/{id}', \CustomerController::class.':update')->add( new AuthMiddleware());

      $this->delete('/customer/delete/{id}', \CustomerController::class.':delete')->add( new AuthMiddleware());
});
