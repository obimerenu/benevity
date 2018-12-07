<?php
/**
  * User Model
  * exposes the User data layer
  *
  * @package    CapitalsObi
  * @subpackage benevsAPI
  * @author     Obi Merenu <obinna@CapitalsObiedge.com>
  */
namespace CapitalsObi\benevsAPI\Model;

class User
{
    /**
     * get user from database.
     *
     * @param string $username
     *
     * @return bool
     */
     public static function getUser($username) {

         $sql = "SELECT * FROM `b_users_table` WHERE `username` = '$username'";

         try{
             $db = new \CapitalsObi\benevsAPI\Config\db();
             $db = $db->connect();

             $stmt = $db->query($sql);
             $user = $stmt->fetchAll(\PDO::FETCH_OBJ);
             $stmt = null;
             $db = null;

             return $user;

         } catch(\PDOException $e){
             echo '{"error": {"text": '.$e->getMessage().'}';
         }

         return false;
     }


     /**
      * check if the token in use is blacklisted  @todo : useable in authMiddleware
      *
      * @param string $username
      * @param int $cust_id
      *
      * @return bool
      */
      public static function blacklistedTokens($username, $cust_id = null) {
          return null;
      }
}
