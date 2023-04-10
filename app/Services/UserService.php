<?php

namespace App\Services;

use App\Contracts\UserRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all users.
     *
     * @return Collection
     */
    public function getAllUsers(): Collection
    {
        return $this->userRepository->all();
    }

    /**
     * Get a user by its primary key.
     *
     * @param int $id
     * @return Model|null
     */
    public function getUserById(int $id): ?Model
    {
        return $this->userRepository->find($id);
    }

    /**
     * Create a new user in the database.
     *
     * @param array $data
     * @return Model
     */
    public function createUser(array $data): Model
    {
        return $this->userRepository->create($data);
    }

    /**
     * Update a user in the database.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateUser(int $id, array $data): bool
    {
        return $this->userRepository->update($id, $data);
    }

    /**
     * Delete a user from the database.
     *
     * @param int $id
     * @return bool
     */
    public function deleteUser(int $id): bool
    {
        return $this->userRepository->delete($id);
    }

    // Add any User specific methods here
}
