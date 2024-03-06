<?php

namespace App\Interfaces\UserInterface;

interface UserRepositoryInterface{
    public function getUser();
    public function userRegistration(array $userDetails);
    public function userLogin(array $userLoginDetails);
    public function userLogout();
}