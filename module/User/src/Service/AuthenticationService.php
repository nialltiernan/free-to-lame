<?php
declare(strict_types=1);

namespace User\Service;

use Laminas\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\Authentication\Result;
use Laminas\Db\Adapter\Adapter as DatabaseAdapter;
use Laminas\Session\Container as Session;
use User\Model\User;
use User\Repository\UserReadRepositoryInterface;

class AuthenticationService implements AuthenticationServiceInterface
{
    public const SERVICE_NAME = 'UserAuthenticationService';

    private DatabaseAdapter $db;
    private UserReadRepositoryInterface $userReadRepository;
    private Session $session;
    private string $username;
    private string $password;
    private ?User $identity;

    public function __construct(DatabaseAdapter $db, UserReadRepositoryInterface $userReadRepository, Session $session)
    {
        $this->db = $db;
        $this->userReadRepository = $userReadRepository;
        $this->session = $session;
        $this->identity = $this->session->user ?? null;
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
            $user = $this->getAuthenticatedUser($authenticator);

            $this->identity = $user;
            $this->session->user = $user;
        }

        return $result;
    }

    private function getAuthenticatedUser(CallbackCheckAdapter $authenticator): User
    {
        $userRow = $authenticator->getResultRowObject();

        return $this->userReadRepository->get($userRow->id);
    }

    public function hasIdentity(): bool
    {
        return $this->identity instanceof User;
    }

    public function getIdentity(): ?User
    {
        return $this->identity;
    }

    public function clearIdentity()
    {
        $this->identity = null;
        $this->session->user = null;
    }

    public function updateUser(User $user)
    {
        $this->session->user = $user;
    }
}
