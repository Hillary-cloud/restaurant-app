<base href="/public">
@extends('layouts.base')
@section('content')
    <div class="container mt-5">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="float-start">New Order</h2>
                        <h5 class="ml-auto"><a href="{{route('admin.order-history')}}" class="text-primary">Order History</a></h5>
                    </div>
                    <div class="card-body">
                    
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order Date</th>
                                        <th>Customer</th>
                                        <th>Table no</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $item)
                                    <tr>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->table->name}}</td>
                                        <td>{{$item->total_price}}</td>
                                        <td>{{$item->status == '0' ? 'pending': 'completed'}}</td>
                                        <td><a class="btn btn-primary" href="{{'/admin/view-order/'.$item->id}}">View</a></td>
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