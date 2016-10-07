<?php

namespace Equip\Project\Transformer;

use League\Fractal\TransformerAbstract;
use Wheniwork\Contract\User\UserRepositoryInterface;
use Wheniwork\Data\Entity\User;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'login_id' => $user->login_id,
            'account_id' => $user->account_id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'role' => $this->roleName($user->role),
        ];
    }

    private function roleName($role)
    {
        switch ($role) {
            case UserRepositoryInterface::ROLE_ADMIN:
                return 'Account Holder';
            case UserRepositoryInterface::ROLE_MANAGER:
                return 'Manager';
            case UserRepositoryInterface::ROLE_EMPLOYEE:
                return 'Employee';
        }
    }
}
