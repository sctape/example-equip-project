<?php

namespace Equip\Project\Exceptions;

use RuntimeException;

class UnauthorizedException extends RuntimeException
{
    const USER_TOKEN_REQUIRED = 1;

    /**
     * @return static
     */
    public static function userTokenRequired()
    {
        return new static(
            'A user token is required to make this request',
            static::USER_TOKEN_REQUIRED
        );
    }

    /**
     * @return int
     */
    public function getHttpStatus()
    {
        return 401;
    }
}
