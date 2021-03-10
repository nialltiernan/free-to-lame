<?php

namespace User\Repository;

use User\Model\UserModel;

interface UserReadRepositoryInterface
{
    public function getAll(): array;

    public function get($id): UserModel;
}
