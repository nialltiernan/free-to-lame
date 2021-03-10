<?php

namespace User\Repository;

use User\Model\UserModel;

interface UserWriteRepositoryInterface
{
    public function create(array $data): UserModel;
}
