<base href="/public">
@extends('layouts.base')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h2>Order Details</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Customer</label>
                                <div class="border p-2">{{$order->name}}</div>
                                <label for="">Email</label>
                                <div class="border p-2">{{$order->email}}</div>
                                <label for="">Table Number</label>
                                <div class="border p-2">{{$order->table->name}}</div>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Plate Quantity</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>{{$item->menus->name}}</td>
                                            <td>{{$item->qty}}</td>
                                            <td>&#8358 {{$item->price}}</td>
                                            <td>
                                                <img src="{{asset('menu_images/'.$item->menus->image)}}" width="50px" alt="">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4>Grand Total: &#8358 {{$order->total_price}}</h4>
                                <form action="{{'/admin/update-order/'.$order->id}}" method="Post">
                                    @csrf
                                    @method('PUT')
                                    <select class="form-control" name="status" id="" >
                                        <option {{$order->status == '0' ? 'selected' : ''}} value="0">Pending</option>
                                        <option  {{$order->status == '1' ? 'selected' : ''}} value="1">Completed</option>
                                    </select>
                                    <button class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
