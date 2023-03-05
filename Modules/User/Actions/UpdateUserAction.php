<?php

use App\Models\User;

class UpdateUserAction {
    public static function execute(string $id, array $data): User {
        $user = User::where('id', $id)->update($data);
        return $user;
    }
}
