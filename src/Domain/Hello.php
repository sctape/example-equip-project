<?php

namespace Equip\Project\Domain;

use Equip\Adr\DomainInterface;
use Equip\Adr\PayloadInterface;
use Wheniwork\Login\Handler\AuthHandler;

class Hello implements DomainInterface
{
    /**
     * @var PayloadInterface
     */
    private $payload;

    /**
     * @param PayloadInterface $payload
     */
    public function __construct(PayloadInterface $payload)
    {
        $this->payload = $payload;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(array $input)
    {
        $claims = $input[AuthHandler::TOKEN_ATTRIBUTE]->getClaims();

        return $this->payload
            ->withStatus(PayloadInterface::STATUS_OK)
            ->withOutput($claims);
    }
}
