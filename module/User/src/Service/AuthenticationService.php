<?php
declare(strict_types=1);

namespace User\Service;

use Laminas\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Laminas\Db\Adapter\Adapter;
use Laminas\Session\Container as Session;
use User\Exception\CouldNotAuthenticateUserException;
use User\Model\UserModel;
use User\Repository\UserReadRepositoryInterface;

class AuthenticationService
{
    /** @var \Laminas\Db\Adapter\Adapter */
    private $adapter;

    /** @var \User\Repository\UserReadRepositoryInterface */
    private $userReadRepository;

    /** @var \Laminas\Session\Container */
    private $session;

    public function __construct(Adapter $adapter, UserReadRepositoryInterface $userReadRepository, Session $session)
    {
        $this->adapter = $adapter;
        $this->userReadRepository = $userReadRepository;
        $this->session = $session;
    }

    /**
     * @param string $username
     * @param string $password
     * @return \User\Model\UserModel
     * @throws \User\Exception\CouldNotAuthenticateUserException
     */
    public function authenticateUser(string $username, string $password): UserModel
    {
        $authAdapter = new CallbackCheckAdapter($this->adapter);

        $authAdapter
            ->setTableName('users')
            ->setIdentityColumn('username')
            ->setCredentialColumn('password')
            ->setCredentialValidationCallback(function($hash, $password) {
                return password_verify($password, $hash);
            });

        $authAdapter->setIdentity($username)->setCredential($password);

        $result = $authAdapter->authenticate();

        if (!$result->isValid()) {
            throw new CouldNotAuthenticateUserException();
        }

        $userRow = $authAdapter->getResultRowObject();

        $user = $this->userReadRepository->get((int)$userRow->id);

        $this->session->user = $user;

        return $user;
    }

    public function isUserGuest(): bool
    {
        return is_null($this->session->user);
    }

    public function isUserLoggedIn(): bool
    {
        return !$this->isUserGuest();
    }
}
