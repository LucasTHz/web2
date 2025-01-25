<?php
namespace App\Enums;

enum UserRolesEnum : int
{
    case ADMIN = 1;
    case CLIENT = 2;
    case PRODUCER = 3;
}