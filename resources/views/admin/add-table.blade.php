<base href="/public">
@extends('layouts.base')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="container">          
            <div class="card">
                <div class="card-header">
                    <h3 class="float-start">Add table</h3>
                    <span class="float-end"><a href="{{route('admin.tables')}}">All tables</a></span>
                </div>
                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success">
                    {{ session('message') }}
                    </div>
                    @endif
                    <form action="{{route('admin.store-table')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-group">
                            <label for="name">Table Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Table name">
                            @error('name')
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