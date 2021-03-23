<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\User;

class CartController extends Controller
{
    public function add(Dish $dish) {
        \Cart::session('_token')->add(array(
            'id' => $dish->id,
            'name' => $dish->name,
            'price' => $dish->price,
            'quantity' => 1,
            'attributes' => array(),
            'user_id' => $dish->user_id,
            'associatedModel' => $dish
        ));

        return back();
    }
    public function index()
    {
        $cartItems = \Cart::session('_token') -> getContent();
        return view('clientPage.index-cart', compact('cartItems'));
    }

    public function destroy($itemId)
    {
        \Cart::session('_token')->remove($itemId);
        return back();
    }

    public function update($rowId)
    {
        \Cart::session('_token')->update($rowId, [
            'quantity' => [
                'relative' => false,
                'value' => request('quantity')
            ]
        ]);
        return back();
    }
}
