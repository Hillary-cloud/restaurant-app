<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $menus = Menu::orderBy('created_at', 'DESC')->get();
        $count = Cart::where('user_id',auth()->id())->count();
        return view('orders.order',compact('menus','count'));
    }

    public function menuView($name){
        $menu = Menu::where('name',$name)->first();
        return view('orders.item-detail',compact('menu'));
    }

    public function OrderIndex(){
        $orders = Order::where('status','0')->get();
        return view('admin.order',compact('orders'));
    }

    public function view($id){
        $order = Order::where('id',$id)->first();
        return view('admin.view-order',compact('order'));
    }

    
    public function update(Request $request, $id){
        $order = Order::find($id);
        $order->status = $request->status;
        $order->update();
        return redirect('/admin/orders')->with('status','Order updated successfully');
    }

    public function orderHistory(){
        $orders = Order::where('status','1')->get();
        return view('admin.order-history',compact('orders'));
    }

}
