@extends('layouts.base')
@section('content')
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>Order form</h2>
            </div><hr>

            <div class="row ">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Your cart</span>
                        <span class="text-primary">Qty</span>
                        <span class="badge bg-primary rounded-pill">Price</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @php
                            use App\Models\Cart;
                            use Illuminate\Support\Facades\Auth;
                            $total = 0;
                        @endphp
                    
                        @foreach ($cartItem as $item)
                        {{-- @if ($item->menus->qty > 0) --}}
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $item->menus->name }}</h6>
                                <small class="text-muted">price: &#8358 {{$item->menus->price}}</small>
                            </div>
                            <span class="text-muted">{{$item->prod_qty}}</span>
                            <span class="text-muted">{{$item->menus->price*$item->prod_qty}}</span>
                        </li>
                        

                        @php
                            $total += $item->menus->price*$item->prod_qty;
                        @endphp
                        {{-- @endif --}}
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (&#8358)</span>
                            <strong>{{$total}}</strong>
                        </li>
                        
                    </ul>
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Customer Details</h4>
                    <form class="needs-validation" method="POST" action="{{route('place-order')}}" novalidate>
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <label for="firstName" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" id="">
                                @error('name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{Auth::user()->email}}">
                                @error('email')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Table</label>
                                <select name="table_id" class="form-control" id="">
                                    <option value="">--Select your table number--</option>
                                    @foreach ($tables as $table)
                                    <option value="{{$table->id}}">{{$table->name}}</option>
                                    @endforeach
                                </select>
                                @error('table_id')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        <button class="w-100 mt-3 btn btn-primary btn-block">Proceed to pay</button>
                    </form>
                    
                    <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                        <div class="row" style="margin-bottom:40px;">
                            <div class="col-md-8 col-md-offset-2">
                             
                                <input type="hidden" name="email" value={{Auth::user()->email}}> {{-- required --}}
                                <input type="hidden" name="id" value="345">
                                <input type="hidden" name="amount" value={{$total * 100}}> {{-- required in kobo --}}
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="currency" value="NGN">
                                <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                
                                {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}
                    
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}
                    
                                <p>
                                    <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                                        <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                                    </button>
                                </p>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </main>

    </div>
@endsection
