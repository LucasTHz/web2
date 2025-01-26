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

    public function edit(string $idGame)
    {
        $game = (new GameModel())->find($idGame);

        return view('user/producer/games/edit', ['game' => $game]);
    }

    public function update(string $idGame)
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

        $gameModel = new GameModel();

        $gameModel->update($idGame, [
            ...$data,
            'producer_id' => session('id_user'),
        ]);

        return redirect()->back()->withInput()->with('success', 'Jogo atualizado com sucesso');
    }

    public function delete(string $idGame)
    {
        (new GameModel())->delete($idGame);

        return redirect()->back()->with('success', 'Jogo deletado com sucesso');
    }
}
