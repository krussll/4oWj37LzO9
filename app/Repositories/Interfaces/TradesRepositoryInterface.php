<?php

namespace App\Repositories\Interfaces;

interface TradesRepositoryInterface
{
    public function GetAllTrades();

    public function GetTradesByPortfolioId($id);

    public function GetActiveHashtagPortfolioTrade($hashtagId, $portfolioId);

    public function GetActiveHashtagTrades($hashtagId);
}
