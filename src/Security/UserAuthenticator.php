<?php
/**
  * UserAuthenticator
  * This class authenticates the User
  *
  * @package    CapitalsObi
  * @subpackage benevsAPI
  * @author     Obi Merenu <obinna@CapitalsObiedge.com>
  */
namespace CapitalsObi\benevsAPI\Security;

use CapitalsObi\benevsAPI\Model\User;

class UserAuthenticator
{
    /**
     * Authenticate username and password against database.
     *
     * @param string $username
     * @param string $password
     *
     * @return bool
     * @return array $user // encoded
     */
     public static function authenticate($username, $password) {

         try{
              $user = User::getUser($username) ;

              if (empty($user[0]->USERNAME)) {
                  return false;
              }

              if (empty($user[0]->PASSWORD)) {
                  return false;
              }

              if (($password == $user[0]->PASSWORD)) {
              // if (password_verify($password, $user[0]->password)) { @// TODO: todo use for hashed passwords
              // encoding throws error when using the password_verify function, mysql fix needed: not entirely necessary,
              // but would be ideal moving forward
                  return json_encode($user,JSON_FORCE_OBJECT) ;
              }

         } catch(\PDOException $e){
             echo '{"error": {"text": '.$e->getMessage().'}';
         }

         return false;
     }
}
