<?php 

namespace App\Repositories\Interfaces;

interface UsersRepositoryInterface
{
    public function GetLatestUsers();

    public function GetUserById($id);

    public function DecreaseBalance($user, $amount);

    public function IncreaseBalance($user, $amount);

    public function GetUsersPositions();

}