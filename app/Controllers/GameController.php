<?php

namespace App\Controllers;

use App\Models\GameModel;
use App\Models\ReviewGameModel;
use App\Models\UserModel;

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
        $img  = $this->request->getFile('img');

        $validated = $this->validate([
            'title'       => 'required',
            'description' => 'required',
            'price'       => 'required|numeric',
            'img'         => 'uploaded[img]|is_image[img]|max_size[img,2048]',
        ]);

        if (!$validated) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($img->isValid() && !$img->hasMoved()) {
            $img->move(WRITEPATH . 'uploads');
            $data['path_img'] = $img->getName();
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
        $img  = $this->request->getFile('img');

        $validated = $this->validate([
            'title'       => 'required',
            'description' => 'required',
            'price'       => 'required|numeric',
            'img'         => 'is_image[img]|max_size[img,2048]',
        ]);

        if (!$validated) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($img->isValid() && !$img->hasMoved()) {
            $img->move(WRITEPATH . 'uploads');
            $data['img'] = $img->getName();
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

    public function show(string $idGame)
    {
        $game = (new GameModel())->find($idGame);
        $reviews = (new ReviewGameModel())->where('game_id', $idGame)->findAll();

        $reviewsWithUser = array_map(function ($review) {
            $review['user_name'] = (new UserModel())->find($review['user_id'])['name'];
            return $review;
        }, $reviews);

        $game['path_img'] = '../uploads' . DIRECTORY_SEPARATOR . $game['path_img'];

        return view('/games/show', ['game' => $game, 'reviews' => $reviewsWithUser]);
    }
}
