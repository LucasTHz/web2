<?php

namespace App\Controllers;

use App\Models\CartModel;

class CartController extends BaseController
{
    public function add(string $idGame)
    {
        $quantity = $this->request->getPost('quantity') ?? 1;
        $idUser   = session('id_user');

        $cart = (new CartModel())->getDataCartItem($idUser);

        $gameExists = false;
        if ($cart) {
            foreach ($cart as $item) {
                if ($item['game_id'] == $idGame) {
                    $quantity += $item['quantity'];
                    (new CartModel())->update($item['id'], [
                        'quantity' => $quantity,
                    ]);
                    $gameExists = true;
                    break;
                }
            }
        }

        if (!$gameExists) {
            (new CartModel())->insert([
                'user_id'  => session('id_user'),
                'game_id'  => $idGame,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->to('/dashboard')->with('success', ['Jogo adicionado ao carrinho']);
    }

    public function show()
    {
        $cart  = session('cart') ?? [];
        $total = 0;
        $games = [];
        $cart = (new CartModel())->getDataCartItem(session('id_user'));

        foreach ($cart as $item) {
            if ($item['id']) {
                $games[] = [
                    'id'       => $item['id'],
                    'title'    => $item['title'],
                    'quantity' => $item['quantity'],
                    'price'    => $item['price'],
                    'total'    => number_format($item['price'] * $item['quantity'], 2, '.', ''),
                ];
                $total += $item['price'] * $item['quantity'];
            }
        }


        return view('cart/show', ['cart' => $games, 'total' => number_format($total, 2, '.', '')]);
    }

    public function remove(string $id)
    {
        (new CartModel())->delete($id);

        return redirect()->back()->with('success', ['Jogo removido do carrinho']);
    }
}
