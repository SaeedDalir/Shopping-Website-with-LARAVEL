<?php

namespace App\Policies;

use App\User;

class ShowPolicy
{
    public function is_seller($user)
    {
        return $user->isSeller();
    }
}
