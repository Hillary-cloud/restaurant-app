<base href="/public">
@extends('layouts.base')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="container">
            <div class="card ">
                <div class="card-header">
                    <span class="float-end"><a href="{{route('admin.add-menu')}}"><button class="btn btn-success">+</button></a></span>
                <h3 class="float-start">Menus</h3>
                </div>
                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success">
                    {{ session('message') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                            
                        <table class="table table-striped table-bordered table-hover"> 
                            @if (count($menus) > 0)
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $menu)
                                    <tr>
                                        <td><img src="/menu_images/{{$menu->image}}" width="100px" class="img-responsive"  alt=""></td>
                                        <td>{{$menu->name}}</td>
                                        <td>{{$menu->description}}</td>
                                        <td>{{$menu->price}}</td>
                                        <td>{{$menu->status}}</td>
                                        <td>
                                            <a href="{{route('admin.edit-menu',$menu->id)}}"><i class="fa fa-edit fa-2x"></i></a>
                                        </td>
                                        <td>
                                            <form action="{{route('admin.delete-menu',$menu->id)}}" method="post">
                                                <button class="ml-1" onclick="return confirm('You are about to delete this menu')"><i class="fa fa-trash fa-2x text-danger"></i></button>                                            
                                                @csrf
                                                @method('delete')
                                                
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @else
                            <p class="text-center text-danger">No menu found</p>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection