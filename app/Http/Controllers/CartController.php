<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CartDataTable;
use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
    $cart = new Cart();
    $cart->user_id = Auth::id();
    $cart->product_id = $request->product_id;
    $cart->quantity = $request->quantity;
    $cart->note = $request->note;
    $product = Produk::find($request->product_id);

    if ($product) {
        $cart->subtotal = $product->harga * $request->quantity;
        $cart->save();

        return redirect()->route('pengguna.cart.index')->with('success', 'Product added to cart successfully.');
    }

    return redirect()->back()->with('error', 'Product not found.');
    }


    public function index(CartDataTable $dataTable)
    {
        return $dataTable->render('pengguna.cart.index');
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cartItem->delete();

        return redirect()->route('pengguna.cart.index')->with('success', 'Product removed from cart successfully.');
    }
}
