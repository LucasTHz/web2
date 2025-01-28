<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\DepositModel;
use App\Models\GameModel;
use App\Models\PurchasesModel;
use App\Models\UserModel;
use DateTime;

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
        $cart  = (new CartModel())->getDataCartItem(session('id_user'));

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

    public function buy()
    {
        $userModel = new UserModel();
        $cartModel = new CartModel();
        $cart      = $cartModel->getDataCartItem(session('id_user'));
        $balance   = $userModel->find(session('id_user'))['balance'];

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        if ($balance < $totalPrice) {
            return redirect()->back()->with('errors', ['Saldo insuficiente']);
        }

        $userModel->update(session('id_user'), [
            'balance' => $balance - $totalPrice,
        ]);

        foreach ($cart as $item) {
            $cartModel->update($item['id'], [
                'purchase_completed' => 1,
            ]);

            (new PurchasesModel())->insert([
                'user_id'  => session('id_user'),
                'game_id'  => $item['game_id'],
                'quantity' => $item['quantity'],
                'total'    => $item['price'] * $item['quantity'],
            ]);
        }

        return redirect()->to('/dashboard')->with('success', ['Compra realizada com sucesso']);
    }

    public function purchaseHistory()
    {
        $purchases = (new PurchasesModel())->where('user_id', session('id_user'))->findAll();
        array_walk($purchases, function (&$purchase) {
            $title = (new GameModel())->find($purchase['game_id'])['title'];

            $purchase = [
                'title'      => $title,
                'quantity'   => $purchase['quantity'],
                'game_id'    => $purchase['game_id'],
                'total'      => $purchase['total'],
                'created_at' => (new DateTime($purchase['created_at']))->format('d/m/Y H:i:s'),
            ];
        });

        return view('cart/purchase_history', ['purchases' => $purchases]);
    }

    public function depositHistory()
    {
        $deposits = (new DepositModel())->where('user_id', session('id_user'))->findAll();

        array_walk($deposits, function (&$deposit) {
            $deposit['created_at'] = (new DateTime($deposit['created_at']))->format('d/m/Y H:i:s');
        });

        return view('cart/deposit_history', ['deposits' => $deposits]);
    }
}
