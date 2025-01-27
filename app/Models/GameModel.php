<?php

namespace App\Models;

use CodeIgniter\Model;

class GameModel extends Model
{
    protected $table         = 'games';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['title', 'description', 'price', 'producer_id', 'path_img'];
}
