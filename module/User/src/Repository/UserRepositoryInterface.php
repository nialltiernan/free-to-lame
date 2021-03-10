<?php

namespace User\Repository;

use User\Model\UserModel;

interface UserRepositoryInterface
{
    public function getAll(): array;

    public function get($id): UserModel;
}
