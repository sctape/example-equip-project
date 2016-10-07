<?php

namespace Equip\Project\Domain;

use Equip\Adr\DomainInterface;
use Equip\Adr\PayloadInterface;
use Wheniwork\Auth\Command\FetchUser;

class Hello implements DomainInterface
{
    /**
     * @var PayloadInterface
     */
    private $payload;

    /**
     * @var FetchUser
     */
    private $fetch_user;

    /**
     * @param PayloadInterface $payload
     * @param FetchUser $fetch_user
     */
    public function __construct(PayloadInterface $payload, FetchUser $fetch_user)
    {
        $this->payload = $payload;
        $this->fetch_user = $fetch_user;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(array $input)
    {
        $user = $this->fetch_user->withOptions($input)->execute();

        return $this->payload
            ->withStatus(PayloadInterface::STATUS_OK)
            ->withOutput($user->toArray());
    }
}
