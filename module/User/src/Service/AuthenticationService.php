<?php
declare(strict_types=1);

namespace User\Service;

use Laminas\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\Authentication\Result;
use Laminas\Db\Adapter\Adapter as DatabaseAdapter;
use Laminas\Session\Container as Session;
use User\Model\UserModel;
use User\Repository\UserReadRepositoryInterface;

class AuthenticationService implements AuthenticationServiceInterface
{
    public const SERVICE_NAME = 'UserAuthenticationService';

    /** @var \Laminas\Db\Adapter\Adapter */
    private $db;

    /** @var \User\Repository\UserReadRepositoryInterface */
    private $userReadRepository;

    /** @var \Laminas\Session\Container */
    private $session;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var \User\Model\UserModel | null */
    private $identity;

    public function __construct(DatabaseAdapter $db, UserReadRepositoryInterface $userReadRepository, Session $session)
    {
        $this->db = $db;
        $this->userReadRepository = $userReadRepository;
        $this->session = $session;
        $this->identity = null;
    }

    public function setCredentials(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authenticate(): Result
    {
        $authenticator = new CallbackCheckAdapter($this->db);

        $authenticator
            ->setTableName('users')
            ->setIdentityColumn('username')
            ->setCredentialColumn('password')
            ->setCredentialValidationCallback(function($hash, $password) {
                return password_verify($password, $hash);
            });

        $authenticator->setIdentity($this->username)->setCredential($this->password);

        $result = $authenticator->authenticate();

        if ($result->isValid()) {
            $this->identity = $this->getAuthenticatedUser($authenticator);
        }

        return $result;
    }

    private function getAuthenticatedUser(CallbackCheckAdapter $authenticator): UserModel
    {
        $userRow = $authenticator->getResultRowObject();

        return $this->userReadRepository->get($userRow->id);
    }

    public function hasIdentity(): bool
    {
        return $this->identity instanceof UserModel;
    }

    public function getIdentity(): ?UserModel
    {
        return $this->identity;
    }

    public function clearIdentity()
    {
        $this->identity = null;
    }
}
