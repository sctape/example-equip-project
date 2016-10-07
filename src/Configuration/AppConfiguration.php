<?php

namespace Equip\Project\Configuration;

use Auryn\Injector;
use Equip\Configuration\ConfigurationInterface;
use Equip\Project\Command\FetchUsersCommand;
use Equip\Project\Command\FetchUsersHandler;
use Wheniwork\Configuration\Tactician\CommandHandlerMappingDictionary;
use Wheniwork\Contract\Login\LoginRepositoryInterface;
use Wheniwork\Contract\User\UserRepositoryInterface;
use Wheniwork\Data\Repository\Pdo\LoginRepository;
use Wheniwork\Data\Repository\Pdo\UserRepository;

class AppConfiguration implements ConfigurationInterface
{
    /**
     * Applies a configuration set to a dependency injector.
     *
     * @param Injector $injector
     */
    public function apply(Injector $injector)
    {
        $injector->alias(UserRepositoryInterface::class, UserRepository::class);
        $injector->alias(LoginRepositoryInterface::class, LoginRepository::class);

        $injector->define(CommandHandlerMappingDictionary::class, [
            ':values' => [
                FetchUsersCommand::class => FetchUsersHandler::class,
            ],
        ]);
    }
}
