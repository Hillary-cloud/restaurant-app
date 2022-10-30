@extends('layouts.base')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h2>My Orders</h2>
                    </div>
                    <div class="card-body">
                        @if (session('message'))
                    <div class="alert alert-success">
                    {{ session('message') }}
                    </div>
                    @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order Date</th>
                                        <th>Table number</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $item)
                                    <tr>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{$item->table->name}}</td>
                                        <td>&#8358 {{$item->total_price}}</td>
                                        <td>{{$item->status == '0' ? 'Pending' : 'Completed'}}</td>
                                        <td><a class="btn btn-primary" href="{{'view-order/'.$item->id}}">View</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection