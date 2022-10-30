<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Cart;

class CartController extends Controller
{

    public function index(){
        $cartItems = Cart::where('user_id',auth()->id())->get();
        return view('orders.cart',compact('cartItems'));
    }

    public function addToCart(Request $request){
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if (auth()->check()) {
            $prod_check = Menu::where('id',$product_id)->first();
            if ($prod_check) {
                if (Cart::where('prod_id',$product_id)->where('user_id',auth()->id())->exists()) {
                    return response()->json(['status' => $prod_check->name." Already added to cart"]);
                }else {
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->user_id = auth()->id();
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->save();
    
                    return response()->json(['status' => $prod_check->name." Added to cart"]);
                }
            }
        }else {
            return response()->json(['status' => "Login to continue"]);
        }
    }

    public function updateCart(Request $request){
        $prod_id = $request->input('prod_id');
        $product_qty = $request->input('prod_qty');

        if (auth()->check()) {
            if (Cart::where('prod_id',$prod_id)->where('user_id',auth()->id())->exists()) {
                $cart = Cart::where('prod_id',$prod_id)->where('user_id',auth()->id())->first();
                $cart->prod_qty = $product_qty;
                $cart->update();
                return response()->json(['status' => " Menu Item quantity updated"]);
            }
        }
    }

    public function romoveCartItem(Request $request){
        if (auth()->check()) {
            $prod_id = $request->input('prod_id');
            if (Cart::where('prod_id',$prod_id)->where('user_id',auth()->id())->exists()) {
                $cartItem = Cart::where('prod_id',$prod_id)->where('user_id',auth()->id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Menu Item removed successully"]);
            }
            
        }else {
            return response()->json(['status' => "Login to Continue"]);
        }
    }

    public function cartCount(){
        $cartcount = Cart::where('user_id',auth()->id())->count();
        return response()->json(['count' => $cartcount]);
    }
}
