<?php
declare(strict_types=1);

namespace User\Repository;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\ReflectionHydrator;
use User\Exception\UserDoesNotExistException;
use User\Model\UserModel;

class UserRepository implements UserRepositoryInterface
{

    /** @var \Laminas\Db\Adapter\AdapterInterface  */
    private $db;

    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $result = $this->getAllUsersResult();

        if ($this->isEmptyResult($result)) {
            return [];
        }

        return $this->getHydratedUserObjectArray($result);
    }

    private function isEmptyResult(ResultInterface $result): bool
    {
        return $result->count() === 0;
    }

    private function getAllUsersResult(): ResultInterface
    {
        $sql = new Sql($this->db);
        $select = $sql->select('users');

        $statement = $sql->prepareStatementForSqlObject($select);
        return $statement->execute();
    }

    private function getHydratedUserObjectArray(ResultInterface $result): array
    {
        $resultSet = new HydratingResultSet(new ReflectionHydrator(), new UserModel());
        $resultSet->initialize($result);

        $users = [];

        foreach ($resultSet as $user) {
            $users[] = $user;
        }

        return $users;
    }

    public function get($id): UserModel
    {
        $result = $this->getUserResult($id);

        if ($this->isEmptyResult($result)) {
            throw new UserDoesNotExistException();
        }

        return $this->getHydratedUserObject($result);
    }

    private function getUserResult($id): ResultInterface
    {
        $sql = new Sql($this->db);
        $select = $sql->select('users');
        $select->where(['id = ?' => $id]);

        $statement = $sql->prepareStatementForSqlObject($select);
        return $statement->execute();
    }

    private function getHydratedUserObject(ResultInterface $result): UserModel
    {
        $resultSet = new HydratingResultSet(new ReflectionHydrator(), new UserModel());
        $resultSet->initialize($result);

        return $resultSet->current();
    }
}
