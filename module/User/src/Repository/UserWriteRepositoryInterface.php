<?php

namespace User\Repository;

use User\Model\UserModel;

interface UserWriteRepositoryInterface
{
    public function create(array $data): UserModel;

    public function update(UserModel $user, array $data): UserModel;

    public function delete(UserModel $user): bool;
}
