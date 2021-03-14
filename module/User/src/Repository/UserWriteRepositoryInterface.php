<?php

namespace User\Repository;

use User\Model\User;

interface UserWriteRepositoryInterface
{
    public function create(array $data): User;

    public function update(User $user, array $data): User;

    public function delete(int $userId): bool;
}
