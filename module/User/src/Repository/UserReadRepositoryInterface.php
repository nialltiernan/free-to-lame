<?php

namespace User\Repository;

use User\Model\User;

interface UserReadRepositoryInterface
{
    public function getAll(): array;

    /**
     * @param $id
     * @return \User\Model\User
     * @throws \User\Exception\UserDoesNotExistException
     */
    public function get($id): User;
}
