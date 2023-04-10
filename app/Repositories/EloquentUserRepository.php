<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryContract;
use App\Models\User;

class EloquentUserRepository  extends EloquentBaseRepository implements UserRepositoryContract
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    // Add any User specific methods here
}
