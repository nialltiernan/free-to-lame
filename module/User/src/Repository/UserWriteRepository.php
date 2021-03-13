<?php
declare(strict_types=1);

namespace User\Repository;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\Sql\Delete;
use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Update;
use RuntimeException;
use User\Exception\UserDoesNotExistException;
use User\Model\UserModel;

class UserWriteRepository implements UserWriteRepositoryInterface
{

    /** @var \Laminas\Db\Adapter\AdapterInterface  */
    private $db;

    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }

    public function create(array $data): UserModel
    {
        $data = $this->prepareData($data);

        $userId = $this->insertUserToDatabase($data);

        return $this->hydratedUserObject($userId, $data);
    }

    private function prepareData(array $data): array
    {
        if (isset($data['submit'])) {
            unset($data['submit']);
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

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
            throw new RuntimeException('Database error occurred during user insert');
        }

        return (int) $result->getGeneratedValue();
    }

    private function hydratedUserObject($id, $data): UserModel
    {
        $user = new UserModel();

        $user->setId($id);
        $user->setEmail($data['email']);
        $user->setUsername($data['username']);
        $user->setPassword($data['username']);
        return $user;
    }

    public function update(UserModel $user, array $data): UserModel
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

    private function rehydrateUserObject(UserModel $user, array $data): void
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
