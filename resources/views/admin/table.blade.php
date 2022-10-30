<base href="/public">
@extends('layouts.base')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="container">
            <div class="card ">
                <div class="card-header">
                    <span class="float-end"><a href="{{route('admin.add-table')}}"><button class="btn btn-success">+</button></a></span>
                <h3 class="float-start">Tables</h3>
                </div>
                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success">
                    {{ session('message') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                            
                        <table class="table table-striped table-bordered table-hover"> 
                            @if (count($tables) > 0)
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tables as $table)
                                    <tr>
                                        <td>{{$table->name}}</td>
                                        <td>
                                            <form action="{{route('admin.delete-table',$table->id)}}" method="post">
                                                <button class="ml-1" onclick="return confirm('You are about to delete this table')"><i class="fa fa-trash fa-2x text-danger"></i></button>                                            
                                                @csrf
                                                @method('delete')
                                                
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @else
                            <p class="text-center text-danger">No table found</p>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection