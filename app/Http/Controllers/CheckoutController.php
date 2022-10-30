<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Table;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index(){
        $tables = Table::all();
        $cartItem = Cart::where('user_id',auth()->id())->get();
        return view('orders.checkout',compact('cartItem','tables'));
    }

    public function placeOrder(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'table_id'=>'required'
        ]);
        $order = new Order;
        $order->user_id = auth()->id();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->table_id = $request->table_id;
    
        $total = 0;
        $cartItem_total = Cart::where('user_id',auth()->id())->get();
        foreach ($cartItem_total as $prod) {
            $total += $prod->menus->price*$prod->prod_qty;
        }
        $order->total_price = $total;
        $order->save();

        $cartItem = Cart::where('user_id',auth()->id())->get();
        foreach ($cartItem as $item) {
         
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $item->menus->price,
            ]);

        }

        $cartItem = Cart::where('user_id',auth()->id())->get();
        Cart::destroy($cartItem);
        return redirect('/my-orders')->with('message', 'order placed successfully');
    }
}
