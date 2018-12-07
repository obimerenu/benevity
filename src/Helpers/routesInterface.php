<?php
/**
  * RoutesInterface
  * All controller classes for API endpoints should inherit this class
  *
  * @package    CapitalsObi
  * @subpackage benevsAPI
  * @author     Obi Merenu <obinna@CapitalsObiedge.com>
  */
namespace CapitalsObi\benevsAPI\Helpers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

interface RoutesInterface {
    function getAll(Request $request, Response $response);
    function getOne(Request $request, Response $response);
    function add(Request $request, Response $response);
    function update(Request $request, Response $response);
    function delete(Request $request, Response $response);
}
