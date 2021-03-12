<?php
declare(strict_types=1);

namespace User\Service;

use Laminas\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;
use Laminas\Db\Adapter\Adapter;
use User\Exception\CouldNotAuthenticateUserException;
use User\Repository\UserReadRepositoryInterface;

class AuthenticationService
{
    /** @var \Laminas\Db\Adapter\Adapter */
    private $adapter;

    /** @var \User\Repository\UserReadRepositoryInterface */
    private $userReadRepository;

    public function __construct(Adapter $adapter, UserReadRepositoryInterface $userReadRepository)
    {
        $this->adapter = $adapter;
        $this->userReadRepository = $userReadRepository;
    }

    public function execute(string $username, string $password)
    {
        $authAdapter = new CredentialTreatmentAdapter($this->adapter);

        $authAdapter->setTableName('users')->setIdentityColumn('username')->setCredentialColumn('password');

        $authAdapter->setIdentity($username)->setCredential($password);

        $result = $authAdapter->authenticate();

        if (!$result->isValid()) {
            throw new CouldNotAuthenticateUserException();
        }

        $userRow = $authAdapter->getResultRowObject();

        return $this->userReadRepository->get((int) $userRow->id);
    }
}
