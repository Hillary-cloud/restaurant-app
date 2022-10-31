<base href="/public">
@extends('layouts.base')
@section('content')
    <div class="container product_data mt-5">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h1><strong>{{ucfirst($menu->name)}}</strong></h1>
                        <img src="{{asset('menu_images/'.$menu->image)}}" class="img-fluid" width="500px" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="card shadow">
                    <div class="card-body">
                      
                        <span class=""><strong>Price: </strong>&#8358 {{$menu->price}}</span><br>
                        <div class="mt-4">
                            <h3><strong>Menu Description</strong></h3>
                            <p>{{$menu->description}}</p>
                        </div>
                        <div class="mt-4">
                            <input type="hidden" value="{{$menu->id}}" class="prod_id">
                            <label for="quantity"><strong>Quantity</strong></label><br>
                            <input type="number" name="quantity" class="qty-input" value="1" min="1">
                        </div>
                        <div class="mt-3">
                            <span class="btn btn-primary addToCartBtn">Add To Cart <i class="fa fa-shopping-cart"></i></span>
                     
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('.addToCartBtn').click(function(e){
                e.preventDefault();
                var product_id = $(this).closest('.product_data').find('.prod_id').val();
                var product_qty = $(this).closest('.product_data').find('.qty-input').val();
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "POST",
                    url: "/add-to-cart",
                    data: {
                        'product_id': product_id,
                        'product_qty': product_qty,
                    },
                    success: function (response) {
                        swal(response.status);
                        // window.location.reload();
                    }

                });
            });
        });
    </script>
@endsection