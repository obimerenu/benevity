<?php
/**
  * AuthMiddleware
  * Runs when authentication is needed by the application
  *
  * @package    CapitalsObi
  * @subpackage benevsAPI
  * @author     Obi Merenu <obinna@CapitalsObiedge.com>
  */
namespace CapitalsObi\benevsAPI\Middleware;

use Firebase\JWT\JWT;

class AuthMiddleware
{
    /**
     * Middleware invokable class method.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {

        if (!$request->hasHeader('authorization')) {
            throw new \UnexpectedValueException('Token not sent in header');
        }

        $userToken = $this->getUserToken($request);
        $tokenData = JWT::decode($userToken, base64_decode(getenv('CapitalsObi_KEY')), [getenv('TOKEN_ALG')]);

        $request = $request->withAttribute('user', $tokenData->data->username);
        $request = $request->withAttribute('token_jti', $tokenData->jti);

        return $next($request, $response);
    }

    /**
     * Get user token from request header.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request PSR7 request
     *
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function getUserToken($request)
    {
        $authHeader = $request->getHeader('authorization');

        if (!$authHeader[0]) {
            throw new \UnexpectedValueException( 'Token not retrieved');
        }

        return $authHeader[0];
    }

}
