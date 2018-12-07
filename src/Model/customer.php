<?php
/**
  * Customer Model
  * exposes the Customer data layer
  *
  * @package    CapitalsObi
  * @subpackage benevsAPI
  * @author     Obi Merenu <obinna@CapitalsObiedge.com>
  */
namespace CapitalsObi\benevsAPI\Model;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Customer
{
    /**
     * get all customers from database.
     *
     * @param string $username
     *
     * @return bool
     * @return string $customers
     */
     public static function getCustomers() {

         // $sql = "SELECT * FROM `b_cust_table`";
         $sql = "SELECT CUST_ID,EMPLOYERADD,EMAIL_ADDRESS FROM `b_cust_table`";

         try{
             $db = new \CapitalsObi\benevsAPI\Config\db();
             $db = $db->connect();

             $stmt = $db->query($sql);
             $customers = $stmt->fetchAll(\PDO::FETCH_OBJ);
             $stmt = null;
             $db = null;

             return $customers;

         } catch(\PDOException $e){
             echo '{"error": {"text": '.$e->getMessage().'}';
         }

         return false;
     }

     /**
      * get customer from database.
      *
      * @param int $id
      *
      * @return string $customer
      */
      public static function getCustomer($id) {
        // customer table has badly encoded characters  DL_NUM & SIN are of type blob
        // fix:https://www.inmotionhosting.com/support/website/databases/how-to-convert-a-database-to-utf-8
        // @todo after applying fix '*' should work so uncomment line below
          // $sql = "SELECT * FROM `b_cust_table` WHERE CUST_ID = '$id'";
          $sql = "SELECT CUST_ID,EMPLOYERADD,EMAIL_ADDRESS,OCCUPATION,EMPLOYERPC,
          EMPYEARS,EMPLOYERCITY,EMPLOYERADD,EMPLOYER,SUFFIX,CUST_TYPE,FAX,CELL_PHONE,WORK_PHONE,
          HOME_PHONE,IDOTHER,ADDRESS_SIG,ADDRESS_MAIL,COUNTRY,POSTAL,PROVINCE,ADDRESS,CITY,SUITE,
          M_STATUS,ELIGABLE,CORP_DATE,DL_EXPIRY

          FROM `b_cust_table` WHERE CUST_ID = '$id'";

          $db = new \CapitalsObi\benevsAPI\Config\db();
          $db = $db->connect();

          $stmt = $db->query($sql);

          $customer = $stmt->fetch(\PDO::FETCH_OBJ);
          $stmt = null;
          $db = null;

         if (!$customer){
           return 'Record '.$id.' does not exist';
         }

          return $customer;
      }

      public static function addCustomer(Request $request, Response $response) {

        $CUST_ID = $request->getParam('CUST_ID');
        $USERNAME = $request->getParam('USERNAME');
        $PASSWORD = $request->getParam('PASSWORD');
        $LOGIN_ENABLE = $request->getParam('LOGIN_ENABLE');
        $F_ID = $request->getParam('F_ID');
        $HOH = $request->getParam('HOH');
        $FIRST_NAME = $request->getParam('FIRST_NAME');
        $MIDDLE = $request->getParam('MIDDLE');
        $LAST_NAME = $request->getParam('LAST_NAME');
        $COMP_NAME = $request->getParam('COMP_NAME');
        $COMP_NUM = $request->getParam('COMP_NUM');
        $COMP_TITLE = $request->getParam('COMP_TITLE');
        $COMP_TYPE = $request->getParam('COMP_TYPE');
        $DATEOFBIRTH = $request->getParam('DATEOFBIRTH');
        $DEPAGES = $request->getParam('DEPAGES');
        $GENDER = $request->getParam('GENDER');
        $SIN = $request->getParam('SIN');  // problematic field
        $STATEMENT_FREQUENCY = $request->getParam('STATEMENT_FREQUENCY');
        $IDTYPE = $request->getParam('IDTYPE');
        $DL_NUM = $request->getParam('DL_NUM');  // problematic field
        $DL_EXPIRY = $request->getParam('DL_EXPIRY');
        $CORP_DATE = $request->getParam('CORP_DATE');
        $ELIGABLE = $request->getParam('ELIGABLE');
        $M_STATUS  = $request->getParam('M_STATUS');
        $SUITE = $request->getParam('SUITE');
        $CITY = $request->getParam('CITY');
        $ADDRESS = $request->getParam('ADDRESS');
        $PROVINCE = $request->getParam('PROVINCE');
        $COUNTRY = $request->getParam('COUNTRY');
        $ADDRESS_MAIL = $request->getParam('ADDRESS_MAIL');
        $ADDRESS_SIG = $request->getParam('ADDRESS_SIG');
        $HOME_PHONE = $request->getParam('HOME_PHONE');
        $IDOTHER = $request->getParam('IDOTHER');
        $WORK_PHONE = $request->getParam('WORK_PHONE');
        $CELL_PHONE = $request->getParam('CELL_PHONE');
        $FAX = $request->getParam('FAX');
        $EMAIL_ADDRESS = $request->getParam('EMAIL_ADDRESS');
        $AUTO_STATEMENT = $request->getParam('AUTO_STATEMENT');
        $ACTIVE = $request->getParam('ACTIVE');
        $CUST_TYPE = $request->getParam('CUST_TYPE');
        $B_ID = $request->getParam('B_ID');
        $BC_ID = $request->getParam('BC_ID');
        $D_ID = $request->getParam('D_ID');
        $CREATED_DATE = $request->getParam('CREATED_DATE');
        $LASTDATE = $request->getParam('LASTDATE');
        $LASTUSER = $request->getParam('LASTUSER');
        $DEPENDANTS = $request->getParam('DEPENDANTS');
        $SUFFIX = $request->getParam('SUFFIX');
        $EMPLOYER = $request->getParam('EMPLOYER');
        $EMPLOYERADD = $request->getParam('EMPLOYERADD');
        $EMPLOYERCITY = $request->getParam('EMPLOYERCITY');
        $EMPLOYERPC = $request->getParam('EMPLOYERPC');
        $OCCUPATION = $request->getParam('OCCUPATION');
        $EMPYEARS = $request->getParam('EMPYEARS');
        $RESTRICTED_ACCESS = $request->getParam('RESTRICTED_ACCESS');
        $NEWSLETTER = $request->getParam('NEWSLETTER');
        $NEWS_DATE = $request->getParam('NEWS_DATE');
        $REL_MAIN = $request->getParam('REL_MAIN');
        $REL_DESC = $request->getParam('REL_DESC');
        $REL_NON = $request->getParam('REL_NON');
        $CIT_CANADA = $request->getParam('CIT_CANADA');
        $CIT_US = $request->getParam('CIT_US');
        $CIT_OTHER = $request->getParam('CIT_OTHER');
        $CIT_DESC = $request->getParam('CIT_DESC');
        $PLACEOFISSUE = $request->getParam('PLACEOFISSUE');
        $NATUREOFBUS = $request->getParam('NATUREOFBUS');
        $JURISDICTION = $request->getParam('JURISDICTION');
        $USER_ID = $request->getParam('USER_ID');

        $sql = "INSERT INTO b_cust_table (CUST_ID,USERNAME,PASSWORD,LOGIN_ENABLE,F_ID,HOH,FIRST_NAME,MIDDLE,LAST_NAME,COMP_NAME,
          COMP_NUM,COMP_TITLE,COMP_TYPE,DATEOFBIRTH,DEPAGES,GENDER,SIN,STATEMENT_FREQUENCY,IDTYPE,DL_NUM,DL_EXPIRY,
           CORP_DATE,ELIGABLE,M_STATUS,SUITE,CITY,ADDRESS,PROVINCE,COUNTRY,ADDRESS_MAIL,ADDRESS_SIG,HOME_PHONE,
           IDOTHER,WORK_PHONE,CELL_PHONE,FAX,EMAIL_ADDRESS,AUTO_STATEMENT,ACTIVE,CUST_TYPE,B_ID,BC_ID,D_ID,
            CREATED_DATE,LASTDATE,LASTUSER,DEPENDANTS,SUFFIX,EMPLOYER,EMPLOYERADD,EMPLOYERCITY,EMPLOYERPC,OCCUPATION,EMPYEARS,
             RESTRICTED_ACCESS,NEWSLETTER,NEWS_DATE,REL_MAIN,REL_DESC,REL_NON,CIT_CANADA,CIT_US,CIT_OTHER,CIT_DESC,PLACEOFISSUE,
             NATUREOFBUS,JURISDICTION,USER_ID
         )
          VALUES
         (:CUST_ID,:USERNAME,:PASSWORD,:LOGIN_ENABLE,:F_ID,:HOH,:FIRST_NAME,:MIDDLE,:LAST_NAME,:COMP_NAME,:COMP_NUM,:COMP_TITLE,:COMP_TYPE,
          :DATEOFBIRTH,:DEPAGES,:GENDER,:SIN,:STATEMENT_FREQUENCY,:IDTYPE,:DL_NUM,:DL_EXPIRY,
          :CORP_DATE,:ELIGABLE,:M_STATUS,:SUITE,:CITY,:ADDRESS,:PROVINCE,:COUNTRY,:ADDRESS_MAIL,:ADDRESS_SIG,:HOME_PHONE,
          :IDOTHER,:WORK_PHONE,:CELL_PHONE,:FAX,:EMAIL_ADDRESS,:AUTO_STATEMENT,:ACTIVE,:CUST_TYPE,:B_ID,:BC_ID,:D_ID,
          :CREATED_DATE,:LASTDATE,:LASTUSER,:DEPENDANTS,:SUFFIX,:EMPLOYER,:EMPLOYERADD,:EMPLOYERCITY,:EMPLOYERPC,:OCCUPATION,:EMPYEARS,
          :RESTRICTED_ACCESS,:NEWSLETTER,:NEWS_DATE,:REL_MAIN,:REL_DESC,:REL_NON,:CIT_CANADA,:CIT_US,:CIT_OTHER,:CIT_DESC,:PLACEOFISSUE,
          :NATUREOFBUS,:JURISDICTION,:USER_ID
        )";

        $db = new \CapitalsObi\benevsAPI\Config\db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':CUST_ID', $CUST_ID);
        $stmt->bindParam(':USERNAME', $USERNAME);
        $stmt->bindParam(':PASSWORD', $PASSWORD);
        $stmt->bindParam(':LOGIN_ENABLE', $LOGIN_ENABLE);
        $stmt->bindParam(':F_ID', $F_ID);
        $stmt->bindParam(':HOH', $HOH);
        $stmt->bindParam(':FIRST_NAME', $FIRST_NAME);
        $stmt->bindParam(':MIDDLE', $MIDDLE);
        $stmt->bindParam(':LAST_NAME', $LAST_NAME);
        $stmt->bindParam(':COMP_NAME', $COMP_NAME);
        $stmt->bindParam(':COMP_NUM', $COMP_NUM);
        $stmt->bindParam(':COMP_TITLE', $COMP_TITLE);
        $stmt->bindParam(':COMP_TYPE', $COMP_TYPE);
        $stmt->bindParam(':DATEOFBIRTH', $DATEOFBIRTH);
        $stmt->bindParam(':DEPAGES', $DEPAGES);
        $stmt->bindParam(':GENDER', $GENDER);
        $stmt->bindParam(':SIN', $SIN);
        $stmt->bindParam(':STATEMENT_FREQUENCY', $STATEMENT_FREQUENCY);
        $stmt->bindParam(':IDTYPE', $IDTYPE);
        $stmt->bindParam(':DL_NUM', $DL_NUM);
        $stmt->bindParam(':DL_EXPIRY', $DL_EXPIRY);
        $stmt->bindParam(':CORP_DATE', $CORP_DATE);
        $stmt->bindParam(':ELIGABLE', $ELIGABLE);
        $stmt->bindParam(':M_STATUS', $M_STATUS);
        $stmt->bindParam(':SUITE', $SUITE);
        $stmt->bindParam(':CITY', $CITY);
        $stmt->bindParam(':ADDRESS', $ADDRESS);
        $stmt->bindParam(':PROVINCE', $PROVINCE);
        $stmt->bindParam(':COUNTRY', $COUNTRY);
        $stmt->bindParam(':ADDRESS_MAIL', $ADDRESS_MAIL);
        $stmt->bindParam(':ADDRESS_SIG', $ADDRESS_SIG);
        $stmt->bindParam(':HOME_PHONE', $HOME_PHONE);
        $stmt->bindParam(':IDOTHER', $IDOTHER);
        $stmt->bindParam(':WORK_PHONE', $WORK_PHONE);
        $stmt->bindParam(':CELL_PHONE', $CELL_PHONE);
        $stmt->bindParam(':FAX', $FAX);
        $stmt->bindParam(':EMAIL_ADDRESS', $EMAIL_ADDRESS);
        $stmt->bindParam(':AUTO_STATEMENT', $AUTO_STATEMENT);
        $stmt->bindParam(':ACTIVE', $ACTIVE);
        $stmt->bindParam(':CUST_TYPE', $CUST_TYPE);
        $stmt->bindParam(':B_ID', $B_ID);
        $stmt->bindParam(':BC_ID', $BC_ID);
        $stmt->bindParam(':D_ID', $D_ID);
        $stmt->bindParam(':CREATED_DATE', $CREATED_DATE);
        $stmt->bindParam(':LASTDATE', $LASTDATE);
        $stmt->bindParam(':LASTUSER', $LASTUSER);
        $stmt->bindParam(':DEPENDANTS', $DEPENDANTS);
        $stmt->bindParam(':SUFFIX', $SUFFIX);
        $stmt->bindParam(':EMPLOYER', $EMPLOYER);
        $stmt->bindParam(':EMPLOYERADD', $EMPLOYERADD);
        $stmt->bindParam(':EMPLOYERCITY', $EMPLOYERCITY);
        $stmt->bindParam(':EMPLOYERPC', $EMPLOYERPC);
        $stmt->bindParam(':OCCUPATION', $OCCUPATION);
        $stmt->bindParam(':EMPYEARS', $EMPYEARS);
        $stmt->bindParam(':RESTRICTED_ACCESS', $RESTRICTED_ACCESS);
        $stmt->bindParam(':NEWSLETTER', $NEWSLETTER);
        $stmt->bindParam(':NEWS_DATE', $NEWS_DATE);
        $stmt->bindParam(':REL_MAIN', $REL_MAIN);
        $stmt->bindParam(':REL_DESC', $REL_DESC);
        $stmt->bindParam(':REL_NON', $REL_NON);
        $stmt->bindParam(':CIT_CANADA', $CIT_CANADA);
        $stmt->bindParam(':CIT_US', $CIT_US);
        $stmt->bindParam(':CIT_OTHER', $CIT_OTHER);
        $stmt->bindParam(':CIT_DESC', $CIT_DESC);
        $stmt->bindParam(':PLACEOFISSUE', $PLACEOFISSUE);
        $stmt->bindParam(':NATUREOFBUS', $NATUREOFBUS);
        $stmt->bindParam(':JURISDICTION', $JURISDICTION);
        $stmt->bindParam(':USER_ID', $USER_ID);

        $stmt->execute();
        $stmt = null;
        $db = null;
      }

      public static function updateCustomer(Request $request, Response $response, $id) {

        $USERNAME = $request->getParam('USERNAME');
        $PASSWORD = $request->getParam('PASSWORD');
        $LOGIN_ENABLE = $request->getParam('LOGIN_ENABLE');
        $F_ID = $request->getParam('F_ID');
        $HOH = $request->getParam('HOH');
        $FIRST_NAME = $request->getParam('FIRST_NAME');
        $MIDDLE = $request->getParam('MIDDLE');
        $LAST_NAME = $request->getParam('LAST_NAME');
        $COMP_NAME = $request->getParam('COMP_NAME');
        $COMP_NUM = $request->getParam('COMP_NUM');
        $COMP_TITLE = $request->getParam('COMP_TITLE');
        $COMP_TYPE = $request->getParam('COMP_TYPE');
        $DATEOFBIRTH = $request->getParam('DATEOFBIRTH');
        $DEPAGES = $request->getParam('DEPAGES');
        $GENDER = $request->getParam('GENDER');
        $SIN = $request->getParam('SIN');  // problematic field
        $STATEMENT_FREQUENCY = $request->getParam('STATEMENT_FREQUENCY');
        $IDTYPE = $request->getParam('IDTYPE');
        $DL_NUM = $request->getParam('DL_NUM');  // problematic field
        $DL_EXPIRY = $request->getParam('DL_EXPIRY');
        $CORP_DATE = $request->getParam('CORP_DATE');
        $ELIGABLE = $request->getParam('ELIGABLE');
        $M_STATUS  = $request->getParam('M_STATUS');
        $SUITE = $request->getParam('SUITE');
        $CITY = $request->getParam('CITY');
        $ADDRESS = $request->getParam('ADDRESS');
        $PROVINCE = $request->getParam('PROVINCE');
        $COUNTRY = $request->getParam('COUNTRY');
        $ADDRESS_MAIL = $request->getParam('ADDRESS_MAIL');
        $ADDRESS_SIG = $request->getParam('ADDRESS_SIG');
        $HOME_PHONE = $request->getParam('HOME_PHONE');
        $IDOTHER = $request->getParam('IDOTHER');
        $WORK_PHONE = $request->getParam('WORK_PHONE');
        $CELL_PHONE = $request->getParam('CELL_PHONE');
        $FAX = $request->getParam('FAX');
        $EMAIL_ADDRESS = $request->getParam('EMAIL_ADDRESS');
        $AUTO_STATEMENT = $request->getParam('AUTO_STATEMENT');
        $ACTIVE = $request->getParam('ACTIVE');
        $CUST_TYPE = $request->getParam('CUST_TYPE');
        $B_ID = $request->getParam('B_ID');
        $BC_ID = $request->getParam('BC_ID');
        $D_ID = $request->getParam('D_ID');
        $CREATED_DATE = $request->getParam('CREATED_DATE');
        $LASTDATE = $request->getParam('LASTDATE');
        $LASTUSER = $request->getParam('LASTUSER');
        $DEPENDANTS = $request->getParam('DEPENDANTS');
        $SUFFIX = $request->getParam('SUFFIX');
        $EMPLOYER = $request->getParam('EMPLOYER');
        $EMPLOYERADD = $request->getParam('EMPLOYERADD');
        $EMPLOYERCITY = $request->getParam('EMPLOYERCITY');
        $EMPLOYERPC = $request->getParam('EMPLOYERPC');
        $OCCUPATION = $request->getParam('OCCUPATION');
        $EMPYEARS = $request->getParam('EMPYEARS');
        $RESTRICTED_ACCESS = $request->getParam('RESTRICTED_ACCESS');
        $NEWSLETTER = $request->getParam('NEWSLETTER');
        $NEWS_DATE = $request->getParam('NEWS_DATE');
        $REL_MAIN = $request->getParam('REL_MAIN');
        $REL_DESC = $request->getParam('REL_DESC');
        $REL_NON = $request->getParam('REL_NON');
        $CIT_CANADA = $request->getParam('CIT_CANADA');
        $CIT_US = $request->getParam('CIT_US');
        $CIT_OTHER = $request->getParam('CIT_OTHER');
        $CIT_DESC = $request->getParam('CIT_DESC');
        $PLACEOFISSUE = $request->getParam('PLACEOFISSUE');
        $NATUREOFBUS = $request->getParam('NATUREOFBUS');
        $JURISDICTION = $request->getParam('JURISDICTION');
        $USER_ID = $request->getParam('USER_ID');

        $sql = "UPDATE b_cust_table SET

          USERNAME = :USERNAME,
          PASSWORD = :PASSWORD,
          LOGIN_ENABLE = :LOGIN_ENABLE,
          F_ID = :F_ID,
          HOH = :HOH,
          FIRST_NAME = :FIRST_NAME,
          MIDDLE = :MIDDLE,
          LAST_NAME = :LAST_NAME,
          COMP_NAME = :COMP_NAME,
          COMP_NUM = :COMP_NUM,
          COMP_TITLE = :COMP_TITLE,
          COMP_TYPE = :COMP_TYPE,
          DATEOFBIRTH = :DATEOFBIRTH,
          DEPAGES = :DEPAGES,
          GENDER = :GENDER,
          SIN = :SIN,
          STATEMENT_FREQUENCY = :STATEMENT_FREQUENCY,
          IDTYPE = :IDTYPE,
          DL_NUM = :DL_NUM,
          DL_EXPIRY = :DL_EXPIRY,
          CORP_DATE = :CORP_DATE,
          ELIGABLE = :ELIGABLE,
          M_STATUS = :M_STATUS,
          SUITE = :SUITE,
          CITY = :CITY,
          ADDRESS = :ADDRESS,
          PROVINCE = :PROVINCE,
          COUNTRY = :COUNTRY,
          ADDRESS_MAIL = :ADDRESS_MAIL,
          ADDRESS_SIG = :ADDRESS_SIG,
          HOME_PHONE = :HOME_PHONE,
          IDOTHER = :IDOTHER,
          WORK_PHONE = :WORK_PHONE,
          CELL_PHONE = :CELL_PHONE,
          FAX = :FAX,
          EMAIL_ADDRESS = :EMAIL_ADDRESS,
          AUTO_STATEMENT = :AUTO_STATEMENT,
          ACTIVE = :ACTIVE,
          CUST_TYPE = :CUST_TYPE,
          B_ID = :B_ID,
          BC_ID = :BC_ID,
          D_ID = :D_ID,
          CREATED_DATE = :CREATED_DATE,
          LASTDATE = :LASTDATE,
          LASTUSER = :LASTUSER,
          DEPENDANTS = :DEPENDANTS,
          SUFFIX = :SUFFIX,
          EMPLOYER = :EMPLOYER,
          EMPLOYERADD = :EMPLOYERADD,
          EMPLOYERCITY = :EMPLOYERCITY,
          EMPLOYERPC = :EMPLOYERPC,
          OCCUPATION = :OCCUPATION,
          EMPYEARS = :EMPYEARS,
          RESTRICTED_ACCESS = :RESTRICTED_ACCESS,
          NEWSLETTER = :NEWSLETTER,
          NEWS_DATE = :NEWS_DATE,
          REL_MAIN = :REL_MAIN,
          REL_DESC = :REL_DESC,
          REL_NON = :REL_NON,
          CIT_CANADA = :CIT_CANADA,
          CIT_US = :CIT_US,
          CIT_OTHER = :CIT_OTHER,
          CIT_DESC = :CIT_DESC,
          PLACEOFISSUE = :PLACEOFISSUE,
          NATUREOFBUS = :NATUREOFBUS,
          JURISDICTION = :JURISDICTION,
          USER_ID = :USER_ID
      WHERE CUST_ID = $id";

        $db = new \CapitalsObi\benevsAPI\Config\db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':USERNAME', $USERNAME);
        $stmt->bindParam(':PASSWORD', $PASSWORD);
        $stmt->bindParam(':LOGIN_ENABLE', $LOGIN_ENABLE);
        $stmt->bindParam(':F_ID', $F_ID);
        $stmt->bindParam(':HOH', $HOH);
        $stmt->bindParam(':FIRST_NAME', $FIRST_NAME);
        $stmt->bindParam(':MIDDLE', $MIDDLE);
        $stmt->bindParam(':LAST_NAME', $LAST_NAME);
        $stmt->bindParam(':COMP_NAME', $COMP_NAME);
        $stmt->bindParam(':COMP_NUM', $COMP_NUM);
        $stmt->bindParam(':COMP_TITLE', $COMP_TITLE);
        $stmt->bindParam(':COMP_TYPE', $COMP_TYPE);
        $stmt->bindParam(':DATEOFBIRTH', $DATEOFBIRTH);
        $stmt->bindParam(':DEPAGES', $DEPAGES);
        $stmt->bindParam(':GENDER', $GENDER);
        $stmt->bindParam(':SIN', $SIN);
        $stmt->bindParam(':STATEMENT_FREQUENCY', $STATEMENT_FREQUENCY);
        $stmt->bindParam(':IDTYPE', $IDTYPE);
        $stmt->bindParam(':DL_NUM', $DL_NUM);
        $stmt->bindParam(':DL_EXPIRY', $DL_EXPIRY);
        $stmt->bindParam(':CORP_DATE', $CORP_DATE);
        $stmt->bindParam(':ELIGABLE', $ELIGABLE);
        $stmt->bindParam(':M_STATUS', $M_STATUS);
        $stmt->bindParam(':SUITE', $SUITE);
        $stmt->bindParam(':CITY', $CITY);
        $stmt->bindParam(':ADDRESS', $ADDRESS);
        $stmt->bindParam(':PROVINCE', $PROVINCE);
        $stmt->bindParam(':COUNTRY', $COUNTRY);
        $stmt->bindParam(':ADDRESS_MAIL', $ADDRESS_MAIL);
        $stmt->bindParam(':ADDRESS_SIG', $ADDRESS_SIG);
        $stmt->bindParam(':HOME_PHONE', $HOME_PHONE);
        $stmt->bindParam(':IDOTHER', $IDOTHER);
        $stmt->bindParam(':WORK_PHONE', $WORK_PHONE);
        $stmt->bindParam(':CELL_PHONE', $CELL_PHONE);
        $stmt->bindParam(':FAX', $FAX);
        $stmt->bindParam(':EMAIL_ADDRESS', $EMAIL_ADDRESS);
        $stmt->bindParam(':AUTO_STATEMENT', $AUTO_STATEMENT);
        $stmt->bindParam(':ACTIVE', $ACTIVE);
        $stmt->bindParam(':CUST_TYPE', $CUST_TYPE);
        $stmt->bindParam(':B_ID', $B_ID);
        $stmt->bindParam(':BC_ID', $BC_ID);
        $stmt->bindParam(':D_ID', $D_ID);
        $stmt->bindParam(':CREATED_DATE', $CREATED_DATE);
        $stmt->bindParam(':LASTDATE', $LASTDATE);
        $stmt->bindParam(':LASTUSER', $LASTUSER);
        $stmt->bindParam(':DEPENDANTS', $DEPENDANTS);
        $stmt->bindParam(':SUFFIX', $SUFFIX);
        $stmt->bindParam(':EMPLOYER', $EMPLOYER);
        $stmt->bindParam(':EMPLOYERADD', $EMPLOYERADD);
        $stmt->bindParam(':EMPLOYERCITY', $EMPLOYERCITY);
        $stmt->bindParam(':EMPLOYERPC', $EMPLOYERPC);
        $stmt->bindParam(':OCCUPATION', $OCCUPATION);
        $stmt->bindParam(':EMPYEARS', $EMPYEARS);
        $stmt->bindParam(':RESTRICTED_ACCESS', $RESTRICTED_ACCESS);
        $stmt->bindParam(':NEWSLETTER', $NEWSLETTER);
        $stmt->bindParam(':NEWS_DATE', $NEWS_DATE);
        $stmt->bindParam(':REL_MAIN', $REL_MAIN);
        $stmt->bindParam(':REL_DESC', $REL_DESC);
        $stmt->bindParam(':REL_NON', $REL_NON);
        $stmt->bindParam(':CIT_CANADA', $CIT_CANADA);
        $stmt->bindParam(':CIT_US', $CIT_US);
        $stmt->bindParam(':CIT_OTHER', $CIT_OTHER);
        $stmt->bindParam(':CIT_DESC', $CIT_DESC);
        $stmt->bindParam(':PLACEOFISSUE', $PLACEOFISSUE);
        $stmt->bindParam(':NATUREOFBUS', $NATUREOFBUS);
        $stmt->bindParam(':JURISDICTION', $JURISDICTION);
        $stmt->bindParam(':USER_ID', $USER_ID);
        $stmt->execute();
        $stmt = null;
        $db = null;

      }

      public static function deleteCustomer($id ) {

          $sql = "DELETE FROM b_cust_table WHERE cust_id = $id";

          $db = new \CapitalsObi\benevsAPI\Config\db();
          $db = $db->connect();

          $stmt = $db->prepare($sql);
          $stmt->execute();
          $stmt = null;
          $db = null;
      }

}
