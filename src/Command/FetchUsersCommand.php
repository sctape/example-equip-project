<?php

namespace Equip\Project\Command;

use function Assert\that;

class FetchUsersCommand
{
    /**
     * @var int
     */
    private $account_id;

    /**
     * @param int $account_id
     */
    public function __construct($account_id)
    {
        $this->account_id = $account_id;

        $this->validate();
    }

    /**
     * @return int
     */
    public function accountId()
    {
        return $this->account_id;
    }

    private function validate()
    {
        that($this->account_id)->integer();
    }
}
