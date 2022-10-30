<base href="/public">
@extends('layouts.base')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="container">          
            <div class="card">
                <div class="card-header">
                    <h3 class="float-start">Add Menu</h3>
                    <span class="float-end"><a href="{{route('admin.menus')}}">All Menus</a></span>
                </div>
                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success">
                    {{ session('message') }}
                    </div>
                    @endif
                    <form action="{{route('admin.store-menu')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" >
                            @error('name')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label><br>
                            <textarea name="description" id="" cols="30" rows="5"></textarea>
                            @error('description')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price per plate</label>
                            <input type="text" class="form-control" name="price" >
                            @error('price')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Menu Image</label>
                            <input type="file" class="form-control" name="image" >
                            @error('image')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection