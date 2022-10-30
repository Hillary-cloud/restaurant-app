<base href="/public">
@extends('layouts.base')
@section('content')
    <div class="container my-4">
        <h1>My Cart</h1>
        <div class="card shadow product_data">
            <div class="card-body">
                @php
                    use App\Models\Cart;
                    $total = 0;
                    
                @endphp
                @if (Cart::where('user_id', auth()->id())->count() < 1)
                    <p class="text-center text-danger">No item in cart
                    <p>
                    @else
                        @foreach ($cartItems as $cartItem)
                            @php
                                $total_price = $cartItem->menus->price * $cartItem->prod_qty;
                            @endphp
                            <div class="row product_data">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 m-auto">
                                    <img src="{{ asset('menu_images/' . $cartItem->menus->image) }}" height="70px"
                                        width="70px" alt="">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-2 col-xs-2 m-auto">
                                    <h3>{{ $cartItem->menus->name }}</h3>
                                </div>
                                <div class="col-md-2 m-auto">
                                    <h3> &#8358 {{ $total_price }}</h3>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-2 col-xs-2 m-auto">
                                    <input type="hidden" class="prod_id" value="{{ $cartItem->prod_id }}">
                                    
                                    <div class="input-group text-center" style="width: 130px">
                                        <button class=" btn-danger input-group-text decrement-btn change-qty">-</button>
                                        <input type="text" class="form-control qty-input" min="1" name="quantity"
                                            value="{{ $cartItem->prod_qty }}" id="">
                                        <button class="btn-danger input-group-text increment-btn change-qty">+</button>
                                    </div>
                                    @php
                                    $total += $cartItem->menus->price * $cartItem->prod_qty;
                                @endphp

                                </div>
                                <div class="col-lg-2 m-auto">
                                    <button class="btn btn-danger btn-sm delete-cart-item">Remove</button>
                                </div>
                            </div>
                            <hr>
                           
                        @endforeach
                @endif
            </div>
            @if (Cart::where('user_id', auth()->id())->count() > 0)
                <div class="card-footer">
                    <p class="float-start">Total: &#8358 {{ $total }} </p>
                    <a href="{{route('checkout')}}" class="float-end btn btn-success">Proceed to make order</a>
                </div>
            @endif
            
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.increment-btn').click(function(e) {
                e.preventDefault();
                var inc_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(inc_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value < 10) {
                    value++;
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }

            });
            $('.decrement-btn').click(function(e) {
                e.preventDefault();
                var dec_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(dec_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }

            });


            $('.delete-cart-item').click(function(e) {
                e.preventDefault();
                var prod_id = $(this).closest('.product_data').find('.prod_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "POST",
                    url: "/delete-cart-item",
                    data: {
                        'prod_id': prod_id,
                    },
                    success: function(response) {
                        window.location.reload();
                        alert(response.status);
                    }

                });
            });

            $('.change-qty').click(function(e) {
                e.preventDefault();
                var prod_id = $(this).closest('.product_data').find('.prod_id').val();
                var qty = $(this).closest('.product_data').find('.qty-input').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "POST",
                    url: "/update-cart",
                    data: {
                        'prod_id': prod_id,
                        'prod_qty': qty,
                    },
                    success: function(response) {
                        window.location.reload();
                    }

                });
            });
        });
    </script>
@endsection
