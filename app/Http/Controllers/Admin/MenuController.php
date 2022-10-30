<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Menu;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    public function index(){
        $menus = Menu::orderBy('created_at', 'DESC')->get(); 
        return view('admin.menu',compact('menus'));
    }

    public function create(){
        return view('admin.add-menu');
    }

    public function storeMenu(Request $request)
    {
       $this->validate($request,[
            'name' => 'required',
            // 'description' => 'required',
            'price' => 'required',
          'image' => 'required|image|mimes:jpg,png,jpeg,gif',
    ]); 
//adding menu image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = '-image-'.Carbon::now()->timestamp.'.'. rand(1,1000).'.'.$file->extension();
            $file->move(public_path('menu_images'),$imageName);

            $menu = new Menu;
            $menu->name = $request->name;
            $menu->description = $request->description;
            $menu->price = $request->price;
            $menu->status = 1;            
            $menu->image = $imageName;
            $menu->save();
        };
 
        return redirect()->back()->with('message', 'menu added successfully');
    }

    public function editMenu($id){
        $menu = Menu::find($id);
        return view('admin.edit-menu',compact('menu'));
    }

    public function updateMenu(Request $request,$id)
    {
       $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        //   'image' => 'required|image|mimes:jpg,png,jpeg,gif',
    ]); 
//update menu image
           
            $menu = Menu::findOrFail($id);
            $menu->name = $request->name;
            $menu->price = $request->price;
            $menu->description = $request->description;
            $menu->status = $request->status;
            $image=$request->file('image');

            if ($image) {
                if (File::exists('menu_images/'.$menu->image)) {
                    File::delete('menu_images/'.$menu->image);
                }
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('menu_images'), $imageName);
                $menu->image = $imageName;
            }

            $menu->save();
 
        return redirect()->back()->with('message', 'menu updated successfully');
    }

    public function deleteMenu($id){
        $menu = Menu::find($id);
        if (File::exists('menu_images/'.$menu->image)) {
            File::delete('menu_images/'.$menu->image);
        }
      
        $menu->delete();

        return redirect()->back()->with('message','menu removed successfully');
    }

}
