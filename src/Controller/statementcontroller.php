<?php
/**
  * StatementController
  * handles statement routes
  *
  * @package    CapitalsObi
  * @subpackage benevsAPI
  * @author     Obi Merenu <obinna@CapitalsObiedge.com>
  */
namespace CapitalsObi\benevsAPI\Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use CapitalsObi\benevsAPI\Model\Statement;
use CapitalsObi\benevsAPI\Helpers\RoutesInterface;


class StatementController extends BaseController implements RoutesInterface
{

     public function getAll(Request $request, Response $response) {

         try{
           $st = Statement::getAllStatements(  $request,   $response) ;
           return $response->withJson($st );

         } catch(\PDOException $e){
             echo '{"error": {"text": '.$e->getMessage().'}';
         }
     }


      public function getOne(Request $request, Response $response) {

          $id = $request->getAttribute('id');
          try{
            $st = Statement::getStatement($request, $response, $id) ;
            return $response->withJson($st );

          } catch(\PDOException $e){
              echo '{"error": {"text": '.$e->getMessage().'}';
          }
      }


      public function add(Request $request, Response $response) {

            try{
              $st = Statement::addStatement($request, $response) ;
              echo '{"notice": {"text": "statement Added"}';

            } catch(\PDOException $e){
                echo '{"error": {"text": '.$e->getMessage().'}';
            }
        }

        // test: http://192.168.33.10/slim-api-demo/api/v1/statement/update/22?REF_NUMBER=50022&CMP_ID=84&USER_ID=500&USE_CMP_NAME=N&COMPANY_NAME=RAINTREE+FINANCIAL+SOLUTIONS&USER_NAME=Lee+Forsberg&ADDRESS=10243 - 178 St NW&CITY=Edmonton&PROVINCE=AB&COUNTRY=Canada&POSTAL=T5S1M3&SUITE&NOTES&CREATED=2013-11-20&CREATED_DATE=2013-11-22&CREATED_BY=222&COMPLETED=2013-11-22&COMP_BY=0&TRANSFERRED=2013-11-25&BATCH_ID=12&TRANS_BY=-1
        public function update(Request $request, Response $response){

            $id = $request->getAttribute('id');
            try{
              $st = Statement::updateStatement($request, $response, $id) ;

                echo '{"notice": {"text": "statement Updated"}';

            } catch(\PDOException $e){
                echo '{"error": {"text": '.$e->getMessage().'}';
            }
        }

        public function delete(Request $request, Response $response){
          $id = $request->getAttribute('id');
          try{
            $st = Statement::deleteStatement($request, $response, $id) ;
            echo '{"notice": {"text": "statement Deleted"}';

            } catch(\PDOException $e){
                echo '{"error": {"text": '.$e->getMessage().'}';
            }
        }

}
