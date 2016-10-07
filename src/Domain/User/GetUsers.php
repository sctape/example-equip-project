<?php

namespace Equip\Project\Domain\User;

use Equip\Adr\DomainInterface;
use Equip\Adr\PayloadInterface;
use Wheniwork\Contract\User\UserRepositoryInterface;

class GetUsers implements DomainInterface
{
    /**
     * @var PayloadInterface
     */
    private $payload;

    /**
     * @var UserRepositoryInterface
     */
    private $users;

    /**
     * @param PayloadInterface $payload
     * @param UserRepositoryInterface $users
     */
    public function __construct(PayloadInterface $payload, UserRepositoryInterface $users)
    {
        $this->payload = $payload;
        $this->users = $users;
    }

    /**
     * Handle domain logic for an action.
     *
     * @param array $input
     *
     * @return PayloadInterface
     */
    public function __invoke(array $input)
    {
        $user = $input['user'];

        $users = $this->users->findBy(['account_id' => $user->account_id]);

        $output = array_map(function($user) {
            return $user->toArray();
        }, $users);

        return $this->payload
            ->withStatus(PayloadInterface::STATUS_OK)
            ->withOutput($output);
    }
}
