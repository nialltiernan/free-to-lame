<?php

namespace User\Repository;

use User\Model\User;

interface UserWriteRepositoryInterface
{
    /**
     * @param array $data
     * @return \User\Model\User
     * @throws \User\Exception\CouldNotCreateUserException
     */
    public function create(array $data): User;

    /**
     * @param \User\Model\User $user
     * @param array $data
     * @return User
     * @throws \User\Exception\UserDoesNotExistException
     */
    public function update(User $user, array $data): User;

    /**
     * @param int $userId
     * @return bool
     * @throws \User\Exception\UserDoesNotExistException
     */
    public function delete(int $userId): bool;
}
