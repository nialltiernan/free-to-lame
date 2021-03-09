<?php
declare(strict_types=1);

namespace User\Repository;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Sql;

class UserRepository implements UserRepositoryInterface
{

    private $db;

    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $sql = new Sql($this->db);

        $select = $sql->select('users');

        $statement = $sql->prepareStatementForSqlObject($select);

        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            return [];
        }

        $resultSet = new ResultSet();
        $resultSet->initialize($result);

        return $resultSet;
    }
}
