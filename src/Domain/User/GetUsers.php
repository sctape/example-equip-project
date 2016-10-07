<?php

namespace Equip\Project\Domain\User;

use Equip\Adr\DomainInterface;
use Equip\Adr\PayloadInterface;
use Equip\Project\Transformer\UserTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
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
     * @var UserTransformer
     */
    private $transformer;

    /**
     * @var Manager
     */
    private $fractal;

    /**
     * @param PayloadInterface $payload
     * @param UserRepositoryInterface $users
     * @param UserTransformer $transformer
     * @param Manager $fractal
     */
    public function __construct(
        PayloadInterface $payload,
        UserRepositoryInterface $users,
        UserTransformer $transformer,
        Manager $fractal
    ) {
        $this->payload = $payload;
        $this->users = $users;
        $this->transformer = $transformer;
        $this->fractal = $fractal;
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

        $output = $this->fractal->createData(new Collection($users, $this->transformer))->toArray();

        return $this->payload
            ->withStatus(PayloadInterface::STATUS_OK)
            ->withOutput($output);
    }
}
