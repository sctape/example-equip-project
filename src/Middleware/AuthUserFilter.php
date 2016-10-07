<?php

namespace Equip\Project\Middleware;

use Equip\Project\Exceptions\UnauthorizedException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthUserFilter
{
    // Add paths that should not be authenticated
    protected $noauth = [
        '/hello',
        '/',
    ];

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     *
     * @return mixed
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ) {
        if ($this->shouldFilter($request) && !$request->getAttribute('user')) {
            throw UnauthorizedException::userTokenRequired();
        }

        return $next($request, $response);
    }

    /**
     * @param ServerRequestInterface $request
     * @return bool
     */
    private function shouldFilter(ServerRequestInterface $request)
    {
        return $request->getMethod() !== "OPTIONS" &&
        !in_array($request->getUri()->getPath(), $this->noauth);
    }
}
