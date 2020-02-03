<?php

namespace App\Domain\Services;

use App\Domain\Components\Containers\RepositoryContainer;
use App\Domain\Repositories\RefundsRepository;
use App\Domain\Repositories\UserRepository;


abstract class ServiceAbstract
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var RefundsRepository
     */
    protected $refundsRepository;


    public function __construct(RepositoryContainer $repositoryContainer)
    {
        $this->userRepository              = $repositoryContainer->getRepository(UserRepository::class);
        $this->refundsRepository           = $repositoryContainer->getRepository(RefundsRepository::class);
    }
}
