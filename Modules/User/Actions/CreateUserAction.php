<?php

use App\Models\User;

class CreateUserAction {
    public static function execute(array $data): User {
        $user = User::create($data);
        return $user;
    }
}