<?php

namespace App\Controllers;

use App\Models\GameModel;

class Home extends BaseController
{
    public function index(): string
    {
        $games = (new GameModel())->findAll();

        return view('dashboard', ['games' => $games]);
    }

    public function dashboard()
    {
        $games = (new GameModel())->findAll();

        return view('dashboard', ['games' => $games]);
    }
}
