<?php

namespace User\Repository;

use User\Model\User;

interface UserReadRepositoryInterface
{
    public function getAll(): array;

    public function get($id): User;
}
