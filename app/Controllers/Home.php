<?php

namespace App\Controllers;

use App\Models\GameModel;

class Home extends BaseController
{
    public function index(): string
    {
        $games = (new GameModel())->findAll();

        return view('welcome_message', ['games' => $games]);
    }
}
