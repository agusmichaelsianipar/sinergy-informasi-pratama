<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getUserByUserID($userID){

        return User::findOrFail($userID);
    }
    public function store($data){
        
        return User::create($data);
    }
    public function update($user, $data){

        return tap($user)->update($data);
    }
}