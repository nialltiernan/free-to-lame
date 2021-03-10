<?php
declare(strict_types=1);

namespace User\Repository;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\AbstractHydrator;
use User\Exception\UserDoesNotExistException;
use User\Model\UserModel;

class UserReadRepository implements UserReadRepositoryInterface
{

    /** @var \Laminas\Db\Adapter\AdapterInterface  */
    private $db;
    /** @var \Laminas\Hydrator\AbstractHydrator */
    private $hydrator;

    public function __construct(AdapterInterface $db, AbstractHydrator $hydrator)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
    }

    public function getAll(): array
    {
        $result = $this->getAllUsersResult();

        if ($this->isEmptyResult($result)) {
            return [];
        }

        return $this->getHydratedUserObjects($result);
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

    private function getHydratedUserObjects(ResultInterface $result): array
    {
        $resultSet = $this->hydrateResultSetWithUserModel($result);

        $users = [];

        foreach ($resultSet as $user) {
            $users[] = $user;
        }

        return $users;
    }

    private function hydrateResultSetWithUserModel(ResultInterface $result): HydratingResultSet
    {
        $resultSet = new HydratingResultSet($this->hydrator, new UserModel());

        $resultSet->initialize($result);

        return $resultSet;
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
        $resultSet = $this->hydrateResultSetWithUserModel($result);

        return $resultSet->current();
    }
}
