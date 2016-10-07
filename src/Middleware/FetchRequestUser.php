<?php

namespace Equip\Project\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Wheniwork\Auth\Command\FetchUser;
use Wheniwork\Login\Handler\AuthHandler;

class FetchRequestUser
{
    /**
     * @var FetchUser
     */
    private $fetch;

    /**
     * @param FetchUser $fetch
     */
    public function __construct(FetchUser $fetch)
    {
        $this->fetch = $fetch;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $token = $request->getAttribute(AuthHandler::TOKEN_ATTRIBUTE);
        $user_id = $request->getAttribute(AuthHandler::USER_ID_ATTRIBUTE);

        if ($token) {
            $user = $this->fetch->withOptions(compact('token', 'user_id'))->execute();
            $request = $request->withAttribute('user', $user);
        } else {
            $request = $request->withAttribute('user', null);
        }

        return $next($request, $response);
    }
}
