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
        $insert = new Insert('users');
        $insert->values($data);

        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface) {
            throw new RuntimeException('Database error occurred during user insert');
        }

        $id = $result->getGeneratedValue();

        $user = new UserModel();

        $user->setId($id);
        $user->setEmail($data['email']);
        $user->setUsername($data['username']);
        $user->setPassword($data['password']);

        return $user;
    }

    public function update(UserModel $user, array $data): UserModel
    {
        if (!$user->getId()) {
            throw new UserDoesNotExistException();
        }

        $update = new Update('users');
        $update->set($data);
        $update->where(['id = ?' => $user->getId()]);

        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($update);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface) {
            throw new RuntimeException('Database error occurred during user update');
        }

        if (isset($data['email'])) {
            $user->setEmail($data['email']);
        }
        if (isset($data['username'])) {
            $user->setUsername($data['username']);
        }
        if (isset($data['password'])) {
            $user->setPassword($data['password']);
        }

        return $user;
    }

    public function delete(UserModel $user): bool
    {
        if (!$user->getId()) {
            throw new UserDoesNotExistException();
        }

        $delete = new Delete('users');
        $delete->where(['id = ?' => $user->getId()]);

        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($delete);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface) {
            return false;
        }

        return true;
    }
}
