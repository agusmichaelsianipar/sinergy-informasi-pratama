<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getUserByUserID($userID);
    public function store($data);
    public function update($user, $data);
}