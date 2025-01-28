<?php

namespace App\Controllers;

use App\Models\GameModel;

class Home extends BaseController
{
    public function dashboard()
    {
        $games = (new GameModel())->findAll();

        array_walk($games, function (&$game) {
            $game['path_img'] = 'uploads' . DIRECTORY_SEPARATOR . ($game['path_img'] ?? '');
        });

        return view('dashboard', ['games' => $games]);
    }
}
