<?php
/**
  * AuthController
  * handles route authentication
  *
  * @package    CapitalsObi
  * @subpackage benevsAPI
  * @author     Obi Merenu
  */
namespace CapitalsObi\benevsAPI\Controller;

use Firebase\JWT\JWT;
use CapitalsObi\benevsAPI\Security\UserAuthenticator;

final class AuthController extends BaseController
{
    /**
     * Login a user.
     *
     * @param Slim\Http\Request  $request
     * @param Slim\Http\Response $response
     *
     * @return Slim\Http\Response
     */
    public function login($request, $response) {

        $userData = $request->getParsedBody();

        if (!$this->validateUserData($userData)) {
            return $response->withJson(['message' => 'Username or Password field not provided.'], 400);
        }

        $user = UserAuthenticator::authenticate($userData['username'], $userData['password']);

        if (!$user) {
            return $response->withJson(['message' => 'Username or Password not valid.'], 401);
        }

        return $response->withJson(['token' => $this->generateToken( $userData['username'] )]);
    }

    /**
     * Generate a token for user with passed username.
     *
     * @param string $username
     *
     * @return string
     */
    private function generateToken($username) {

        $appSecret = base64_decode(getenv('CapitalsObi_KEY'));
        $jwtAlgorithm = getenv('TOKEN_ALG');
        $timeIssued = time();
        $tokenId = base64_encode(random_bytes(32));
        $token = [
            'iat'  => $timeIssued,
            'jti'  => $tokenId,
            'nbf'  => $timeIssued,
            'exp'  => $timeIssued + 60 * 60 * 24 * 10,  // expires in 10 days
            'data' => [
                'userId'   => 'empty',
                'username'   => $username,
            ],
        ];
        return JWT::encode($token, $appSecret, $jwtAlgorithm);
    }

    /**
     * Validate user data are correct.
     *
     * @param array $userData
     *
     * @return bool
     */
    private function validateUserData($userData) {
      if ( empty($userData['username']) || empty($userData['password']) ) {
        return false;
      }
      return $userData;
    }
}
