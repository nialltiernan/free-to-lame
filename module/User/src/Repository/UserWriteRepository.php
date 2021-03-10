<?php
declare(strict_types=1);

namespace User\Repository;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\Sql;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\ReflectionHydrator;
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

        $id = $result->getGeneratedValue();

        $user = new UserModel();

        $user->setId($id);
        $user->setEmail($data['email']);
        $user->setUsername($data['username']);
        $user->setPassword($data['password']);

        return $user;
    }
}
