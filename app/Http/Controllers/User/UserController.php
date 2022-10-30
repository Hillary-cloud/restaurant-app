<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class UserController extends Controller
{
    public function index(){
        $order = Order::where('user_id',auth()->id())->get();
        return view('user.my-order',compact('order'));
    }

    public function viewOrder($id){
        $order = Order::where('id',$id)->where('user_id',auth()->id())->first();
        return view('user.view-order',compact('order'));
    }
}
