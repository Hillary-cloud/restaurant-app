<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class HomeController extends Controller
{
    public function index(){
        $menus = Menu::orderBy('created_at', 'DESC')->paginate(50); 
        
        return view('index',compact('menus'));
    }
}
