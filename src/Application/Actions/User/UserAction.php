<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use Illuminate\Database\Connection;
use App\Application\Actions\Action;
use App\Domain\User\UserRepository;
use Psr\Log\LoggerInterface;

abstract class UserAction extends Action
{
   /**
     * @var Connection
     */
    private $connection;
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param LoggerInterface $logger
     * @param UserRepository  $userRepository
     */
    public function __construct(LoggerInterface $logger, UserRepository $userRepository, Connection $connection)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
        $this->connection = $connection;

    }
}
