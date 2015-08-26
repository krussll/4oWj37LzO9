<?php 

namespace App\Repositories\Interfaces;

interface PortfoliosRepositoryInterface
{
    public function DecreaseBalance($portfolio, $amount);

    public function IncreaseBalance($portfolio, $amount);

    public function GetByUserId($userId);
}