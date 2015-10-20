<?php

namespace App\Repositories\Interfaces;

interface TradesRepositoryInterface
{
    public function GetAllTrades();

    public function GetTradesByPortfolioId($id);

    public function GetActiveProfilePortfolioTrade($hashtagId, $portfolioId);

    public function GetActiveProfileTrades($hashtagId);
}
