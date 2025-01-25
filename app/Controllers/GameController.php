<?php

namespace App\Controllers;

use App\Models\GameModel;

class GameController extends BaseController
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('user/producer/games/create');
    }

    public function store()
    {
        $data = $this->request->getPost();

        $validated = $this->validate([
            'title'       => 'required',
            'description' => 'required',
            'price'       => 'required|numeric',
        ]);

        if (!$validated) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        (new GameModel())->insert([
            ...$data,
            'producer_id' => session('id_user'),
        ]);

        return redirect()->to('/user/producer/game/create')->with('success', 'Jogo cadastrado com sucesso');
    }
}
