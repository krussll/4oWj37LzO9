<?php 

namespace App\Repositories\Interfaces;

interface HashtagsRepositoryInterface
{
    public function GetLatestHashtags($limit);

    public function GetHashtagsByNameLike($name);

    public function GetHashtagById($id);

    public function GetPopularHashtags($limit);

    public function GetHashtagPrices($id);

    public function HashtagsList($page, $length);

    public function CountHashtags();
}