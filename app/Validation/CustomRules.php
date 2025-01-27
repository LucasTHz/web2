<?php

namespace App\Validation;

use App\Models\UserModel;
use DateTime;

class CustomRules
{
    public function isAdult(string $date): bool
    {
        $dob = new DateTime($date);
        $now = new DateTime();
        $age = $now->diff($dob)->y;

        return $age >= 18;
    }

    public function dateFuture(string $date): bool
    {
        $now       = new DateTime();
        $inputDate = new DateTime($date);

        return $inputDate <= $now;
    }

    public function strongPassword(string $password): bool
    {
        $uppercase    = preg_match('/[A-Z]/', $password);
        $lowercase    = preg_match('/[a-z]/', $password);
        $number       = preg_match('/[0-9]/', $password);
        $specialChars = preg_match('/[^\w]/', $password);

        return $uppercase && $lowercase && $number && $specialChars;
    }

    public function isUniqueEmail(string $email, string $id): bool
    {
        $user = (new UserModel())->where('email', $email)->first();

        return !$user || $user['id'] == $id;
    }
}
