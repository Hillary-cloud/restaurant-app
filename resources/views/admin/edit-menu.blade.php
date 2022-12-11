<base href="/public">
@extends('layouts.base')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="container">          
            <div class="card">
                <div class="card-header">
                    <h3 class="float-start">Edit Menu</h3>
                    <span class="float-end"><a href="{{route('admin.menus')}}">All Menus</a></span>
                </div>
                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success">
                    {{ session('message') }}
                    </div>
                    @endif
                    <form action="{{route('admin.update-menu',$menu->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                       @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="{{$menu->name}}" name="name" >
                            @error('name')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label><br>
                            <textarea name="description" id="" cols="30" rows="5">{{$menu->description}}</textarea>
                            @error('description')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price per plate</label>
                            <input type="text" class="form-control" name="price" value="{{$menu->price}}">
                            @error('price')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                        <label class="" for="">Status (1 to display on menu page and 0 not to display on menu page)</label>
                        <select name="status" class="form-control" id="">
                            <option value="{{$menu->status}}">{{$menu->status}}</option>
                        <option value="1">1</option>
                        <option value="0">0</option>
                        </select>
                            @error('status')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                    </div>
                        <div class="form-group">
                            <label for="image">Menu Image</label>
                            <input type="file" class="form-control" name="image" >
                            <img src="/menu_images/{{$menu->image}}" alt="" style="display: block" width="250px" class="mt-2 img-responsive">
                            @error('image')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection