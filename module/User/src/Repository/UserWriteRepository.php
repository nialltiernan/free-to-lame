<?php
declare(strict_types=1);

namespace User\Repository;

use Laminas\Db\Adapter\AdapterInterface as DatabaseAdapter;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\Sql\Delete;
use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Update;
use RuntimeException;
use User\Event\UserCreatedEvent;
use User\Exception\CouldNotCreateUserException;
use User\Exception\UserDoesNotExistException;
use User\Model\User;

class UserWriteRepository implements UserWriteRepositoryInterface
{

    public const DEFAULT_COLOR = '#ff0000';

    private DatabaseAdapter $db;
    private UserCreatedEvent $createdEvent;

    public function __construct(DatabaseAdapter $db, UserCreatedEvent $createdEvent)
    {
        $this->db = $db;
        $this->createdEvent = $createdEvent;
    }

    public function create(array $data): User
    {
        $data = $this->prepareData($data);

        $userId = $this->insertUserToDatabase($data);

        $user = $this->hydratedUserObject($userId, $data);

        $this->createdEvent->fire($user);

        return $user;
    }

    private function prepareData(array $data): array
    {
        if (isset($data['submit'])) {
            unset($data['submit']);
        }

        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }

    private function insertUserToDatabase(array $data): int
    {
        $insert = new Insert('users');
        $insert->values($data);

        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface) {
            throw new CouldNotCreateUserException();
        }

        return (int) $result->getGeneratedValue();
    }

    private function hydratedUserObject($id, $data): User
    {
        $user = new User();

        $user->setId($id);
        $user->setEmail($data['email']);
        $user->setUsername($data['username']);
        $user->setPassword($data['username']);
        $user->setColor(self::DEFAULT_COLOR);

        return $user;
    }

    public function update(User $user, array $data): User
    {
        if (!$user->getId()) {
            throw new UserDoesNotExistException();
        }

        $data = $this->prepareData($data);

        $this->updateUserInDatabase($user->getId(), $data);

        $this->rehydrateUserObject($user, $data);

        return $user;
    }

    private function updateUserInDatabase(int $userId, array $data): void
    {
        $update = new Update('users');
        $update->set($data);
        $update->where(['id = ?' => $userId]);

        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($update);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface) {
            throw new RuntimeException('Database error occurred during user update');
        }
    }

    private function rehydrateUserObject(User $user, array $data): void
    {
        if (isset($data['email'])) {
            $user->setEmail($data['email']);
        }
        if (isset($data['username'])) {
            $user->setUsername($data['username']);
        }
        if (isset($data['password'])) {
            $user->setPassword($data['password']);
        }
        if (isset($data['color'])) {
            $user->setColor($data['color']);
        }
    }

    public function delete(int $userId): bool
    {
        if (!$userId) {
            throw new UserDoesNotExistException();
        }

        $result = $this->deleteUserFromDatabase($userId);

        return $result instanceof ResultInterface;
    }

    private function deleteUserFromDatabase(int $userId): ResultInterface
    {
        $delete = new Delete('users');
        $delete->where(['id = ?' => $userId]);

        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
}
