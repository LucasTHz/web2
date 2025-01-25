<?php

namespace App\Validation;

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

    //strongPassword

    public function strongPassword(string $password): bool
    {
        $uppercase    = preg_match('/[A-Z]/', $password);
        $lowercase    = preg_match('/[a-z]/', $password);
        $number       = preg_match('/[0-9]/', $password);
        $specialChars = preg_match('/[^\w]/', $password);

        return $uppercase && $lowercase && $number && $specialChars;
    }
}
