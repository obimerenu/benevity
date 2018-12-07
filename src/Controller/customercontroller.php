<?php
/**
  * CustomerController
  * handles Customer routes
  *
  * @package    CapitalsObi
  * @subpackage benevsAPI
  * @author     Obi Merenu <obinna@CapitalsObiedge.com>
  */
namespace CapitalsObi\benevsAPI\Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use CapitalsObi\benevsAPI\Model\Customer;
use CapitalsObi\benevsAPI\Helpers\RoutesInterface;


class CustomerController extends BaseController implements RoutesInterface
{

     public function getAll(Request $request, Response $response) {
         try{
           $st = Customer::getCustomers() ;
           return $response->withJson($st );

         } catch(\PDOException $e){
             echo '{"error": {"text": '.$e->getMessage().'}';
         }
     }


      public function getOne(Request $request, Response $response) {
          $id = $request->getAttribute('id');

          try{
            $st = Customer::getCustomer( $id);

            return $response->withJson($st );

          } catch(\PDOException $e){
              echo '{"error": {"text": '.$e->getMessage().'}';
          }
      }

      public function add(Request $request, Response $response) {

            try{
              $st = Customer::addCustomer($request, $response) ;
              echo '{"notice": {"text": "Customer Added"}';

            } catch(\PDOException $e){
                echo '{"error": {"text": '.$e->getMessage().'}';
            }
      }

      public function update(Request $request, Response $response) {
          $id = $request->getAttribute('id');
          try{
              Customer::updateCustomer($request, $response, $id) ;

              echo '{"notice": {"text": "Customer "'.$id. '" Updated"}';

          } catch(\PDOException $e){
              echo '{"error": {"text": '.$e->getMessage().'}';
          }
      }

      public function delete(Request $request, Response $response) {
        $id = $request->getAttribute('id');
        try{
          $st = Customer::deleteCustomer($id) ;
          echo '{"notice": {"text": "customer Deleted"}';

          } catch(\PDOException $e){
              echo '{"error": {"text": '.$e->getMessage().'}';
          }
      }

}
