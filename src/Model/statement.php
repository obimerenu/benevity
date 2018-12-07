<?php
/**
  * Statement Model
  * exposes the Statement data layer
  *
  * @package    CapitalsObi
  * @subpackage benevsAPI
  * @author     Obi Merenu <obinna@CapitalsObiedge.com>
  */
namespace CapitalsObi\benevsAPI\Model;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Statement
{

     public static function getAllStatements(Request $request, Response $response) {
         $sql = "SELECT * FROM a_statements";

             $db = new \CapitalsObi\benevsAPI\Config\db();
             $db = $db->connect();

             $stmt = $db->query($sql);
             $statements = $stmt->fetchAll(\PDO::FETCH_OBJ);
             $stmt = null;
             $db = null;

             return  $statements;
     }

      public static function getStatement(Request $request, Response $response, $id) {
          $sql = "SELECT * FROM a_statements WHERE S_ID = $id";
              $db = new \CapitalsObi\benevsAPI\Config\db();
              $db = $db->connect();

              $stmt = $db->query($sql);
              $statement = $stmt->fetch(\PDO::FETCH_OBJ);
              $stmt = null;
              $db = null;

             if (!$statement){
               return 'Record '.$id.' does not exist';
             }

              return $statement;
      }

      public static function addStatement(Request $request, Response $response){

            $ref_number = $request->getParam('REF_NUMBER');
            $cmp_id = $request->getParam('CMP_ID');
            $user_id = $request->getParam('USER_ID');
            $use_cmp_name = $request->getParam('USE_CMP_NAME');
            $company_name = $request->getParam('COMPANY_NAME');
            $user_name = $request->getParam('USER_NAME');
            $address = $request->getParam('ADDRESS');
            $city = $request->getParam('CITY');
            $province = $request->getParam('PROVINCE');
            $country = $request->getParam('COUNTRY');
            $postal = $request->getParam('POSTAL');
            $suite = $request->getParam('SUITE');
            $notes = $request->getParam('NOTES');
            $created = $request->getParam('CREATED');
            $created_date = $request->getParam('CREATED_DATE');
            $created_by = $request->getParam('CREATED_BY');
            $completed = $request->getParam('COMPLETED');
            $comp_by = $request->getParam('COMP_BY');
            $transfered = $request->getParam('TRANSFERRED');
            $batch_id = $request->getParam('BATCH_ID');
            $trans_by = $request->getParam('TRANS_BY');

            $sql = "INSERT INTO a_statements (REF_NUMBER,CMP_ID,USER_ID,USE_CMP_NAME,COMPANY_NAME,USER_NAME,ADDRESS,CITY,PROVINCE,COUNTRY
            ,POSTAL,SUITE,NOTES,CREATED,CREATED_DATE,CREATED_BY,COMPLETED,COMP_BY,TRANSFERRED,BATCH_ID,TRANS_BY) VALUES
            (:REF_NUMBER,:CMP_ID,:USER_ID,:USE_CMP_NAME,:COMPANY_NAME,:USER_NAME,:ADDRESS,:CITY,:PROVINCE,:COUNTRY,:POSTAL,:SUITE,:NOTES,
              :CREATED,:CREATED_DATE,:CREATED_BY,:COMPLETED,:COMP_BY,:TRANSFERRED,:BATCH_ID,:TRANS_BY)";


                $db = new \CapitalsObi\benevsAPI\Config\db();
                $db = $db->connect();

                $stmt = $db->prepare($sql);

                $stmt->bindParam(':REF_NUMBER', $ref_number);
                $stmt->bindParam(':CMP_ID',  $cmp_id);
                $stmt->bindParam(':USER_ID',      $user_id);
                $stmt->bindParam(':USE_CMP_NAME',      $use_cmp_name);
                $stmt->bindParam(':COMPANY_NAME',    $company_name);
                $stmt->bindParam(':USER_NAME',       $user_name);
                $stmt->bindParam(':ADDRESS',      $address);
                $stmt->bindParam(':CITY',  $city);
                $stmt->bindParam(':PROVINCE',      $province);
                $stmt->bindParam(':COUNTRY',      $country);
                $stmt->bindParam(':POSTAL',    $postal);
                $stmt->bindParam(':SUITE',       $suite);
                $stmt->bindParam(':NOTES',      $notes);
                $stmt->bindParam(':CREATED',  $created);
                $stmt->bindParam(':CREATED_DATE',      $created_date);
                $stmt->bindParam(':CREATED_BY',      $created_by);
                $stmt->bindParam(':COMPLETED',    $completed);
                $stmt->bindParam(':COMP_BY',       $comp_by);
                $stmt->bindParam(':TRANSFERRED',      $transfered);
                $stmt->bindParam(':BATCH_ID',       $batch_id);
                $stmt->bindParam(':TRANS_BY',      $trans_by);

                $stmt->execute();
                $stmt = null;
                $db = null;
        }

        // test: http://192.168.33.10/slim-api-demo/api/v1/statement/update/22?REF_NUMBER=50022&CMP_ID=84&USER_ID=500&USE_CMP_NAME=N&COMPANY_NAME=RAINTREE+FINANCIAL+SOLUTIONS&USER_NAME=Lee+Forsberg&ADDRESS=10243 - 178 St NW&CITY=Edmonton&PROVINCE=AB&COUNTRY=Canada&POSTAL=T5S1M3&SUITE&NOTES&CREATED=2013-11-20&CREATED_DATE=2013-11-22&CREATED_BY=222&COMPLETED=2013-11-22&COMP_BY=0&TRANSFERRED=2013-11-25&BATCH_ID=12&TRANS_BY=-1
        public static function updateStatement(Request $request, Response $response, $id){

            $ref_number = $request->getParam('REF_NUMBER');
            $cmp_id = $request->getParam('CMP_ID');
            $user_id = $request->getParam('USER_ID');
            $use_cmp_name = $request->getParam('USE_CMP_NAME');
            $company_name = $request->getParam('COMPANY_NAME');
            $user_name = $request->getParam('USER_NAME');
            $address = $request->getParam('ADDRESS');
            $city = $request->getParam('CITY');
            $province = $request->getParam('PROVINCE');
            $country = $request->getParam('COUNTRY');
            $postal = $request->getParam('POSTAL');
            $suite = $request->getParam('SUITE');
            $notes = $request->getParam('NOTES');
            $created = $request->getParam('CREATED');
            $created_date = $request->getParam('CREATED_DATE');
            $created_by = $request->getParam('CREATED_BY');
            $completed = $request->getParam('COMPLETED');
            $comp_by = $request->getParam('COMP_BY');
            $transfered = $request->getParam('TRANSFERRED');
            $batch_id = $request->getParam('BATCH_ID');
            $trans_by = $request->getParam('TRANS_BY');

            $sql = "UPDATE a_statements SET
        				    ref_number = :REF_NUMBER,
                     cmp_id = :CMP_ID,
                     user_id = :USER_ID,
                     use_cmp_name = :USE_CMP_NAME,
                     company_name = :COMPANY_NAME,
                     user_name = :USER_NAME,
                     address = :ADDRESS,
                     city = :CITY,
                     province = :PROVINCE,
                     country = :COUNTRY,
                     postal = :POSTAL,
                     suite = :SUITE,
                     notes = :NOTES,
                     created = :CREATED,
                     created_date = :CREATED_DATE,
                     created_by = :CREATED_BY,
                     completed = :COMPLETED,
                     comp_by = :COMP_BY,
                     transferred = :TRANSFERRED,
                     batch_id = :BATCH_ID,
                     trans_by = :TRANS_BY
        			WHERE S_ID = $id";

                $db = new \CapitalsObi\benevsAPI\Config\db();
                $db = $db->connect();

                $stmt = $db->prepare($sql);

                $stmt->bindParam(':REF_NUMBER', $ref_number);
                $stmt->bindParam(':CMP_ID',  $cmp_id);
                $stmt->bindParam(':USER_ID',      $user_id);
                $stmt->bindParam(':USE_CMP_NAME',      $use_cmp_name);
                $stmt->bindParam(':COMPANY_NAME',    $company_name);
                $stmt->bindParam(':USER_NAME',       $user_name);
                $stmt->bindParam(':ADDRESS',      $address);
                $stmt->bindParam(':CITY',  $city);
                $stmt->bindParam(':PROVINCE',      $province);
                $stmt->bindParam(':COUNTRY',      $country);
                $stmt->bindParam(':POSTAL',    $postal);
                $stmt->bindParam(':SUITE',       $suite);
                $stmt->bindParam(':NOTES',      $notes);
                $stmt->bindParam(':CREATED',  $created);
                $stmt->bindParam(':CREATED_DATE',      $created_date);
                $stmt->bindParam(':CREATED_BY',      $created_by);
                $stmt->bindParam(':COMPLETED',    $completed);
                $stmt->bindParam(':COMP_BY',       $comp_by);
                $stmt->bindParam(':TRANSFERRED',      $transfered);
                $stmt->bindParam(':BATCH_ID',       $batch_id);
                $stmt->bindParam(':TRANS_BY',      $trans_by);

                $stmt->execute();
                $stmt = null;
                $db = null;
        }

        public static function deleteStatement(Request $request, Response $response, $id ){

            $sql = "DELETE FROM a_statements WHERE s_id = $id";

            $db = new \CapitalsObi\benevsAPI\Config\db();
            $db = $db->connect();

            $stmt = $db->prepare($sql);
            $stmt->execute();
            $stmt = null;
            $db = null;
        }

}
