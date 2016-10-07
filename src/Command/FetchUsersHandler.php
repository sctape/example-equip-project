<?php

namespace Equip\Project\Command;

use Wheniwork\Contract\User\UserRepositoryInterface;

class FetchUsersHandler
{
    /**
     * @var UserRepositoryInterface
     */
    private $users;

    /**
     * @param UserRepositoryInterface $users
     */
    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

    public function handle(FetchUsersCommand $command)
    {
        return $this->users->findBy([
            'account_id' => $command->accountId(),
        ]);
    }
}
