<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface UserRepositoryContract
{
    /**
     * Get all records.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Find a record by its primary key.
     *
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model;

    /**
     * Create a new record in the database.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Update a record in the database.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a record from the database.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    // Add any User specific methods here
}
