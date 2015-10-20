<?php

namespace App\Repositories\Interfaces;

interface ProfilesRepositoryInterface
{
    public function GetLatestProfiles($limit);

    public function GetProfilesByNameLike($name);

    public function GetProfileById($id);

    public function GetPopularProfiles($limit);

    public function GetProfilePrices($id);

    public function ProfilesList($page, $length);

    public function CountProfiles();
}
