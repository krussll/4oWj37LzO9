<?php

namespace App\Repositories\Interfaces;

interface ProfilesRepositoryInterface
{
    public function GetLatestHashtags($limit);

    public function GetHashtagsByNameLike($name);

    public function GetProfileById($id);

    public function GetPopularProfiles($limit);

    public function GetProfilePrices($id);

    public function ProfilesList($page, $length);

    public function CountProfiles();
}
