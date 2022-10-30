<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;

class TableController extends Controller
{
    public function index(){
        $tables = Table::orderBy('created_at', 'DESC')->get(); 
        return view('admin.table',compact('tables'));
    }

    public function create(){
        return view('admin.add-table');
    }

    public function storeTable(Request $request)
    {
       $this->validate($request,[
            'name' => 'required',
        ]); 

            $table = new Table;
            $table->name = $request->name;
            $table->save();

            return redirect()->back()->with('message', 'Table added successfully');
    }
 
       

    public function editTable($id){
        $table = Table::find($id);
        return view('admin.edit-table',compact('table'));
    }

    public function deleteTable($id){
        $table = Table::find($id);
        $table->delete();

        return redirect()->back()->with('message','Table removed successfully');
    }
}
