<?php

namespace App\Repositories\Interfaces;

interface ProfilesRepositoryInterface
{
    public function GetLatestHashtags($limit);

    public function GetHashtagsByNameLike($name);

    public function GetProfileById($id);

    public function GetPopularHashtags($limit);

    public function GetProfilePrices($id);

    public function HashtagsList($page, $length);

    public function CountHashtags();
}
