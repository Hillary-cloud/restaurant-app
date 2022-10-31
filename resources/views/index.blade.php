@extends('layouts.base')
@section('content')
<div class="container-fluid">
    <div class="image-box">
        <img src="{{asset('assets/img/fruits.jpg')}}" alt="" data-aos="fade-left" data-aos-duration="2000" style="width: 100%;" class="d-block w-100 img-fluid">
    </div>
</div>
            <!-- our collection -->
            <div class="container py-2">
                <h1 class="text-center py-3" data-aos="fade-left"
                    data-aos-duration="2000" style="color: rgb(175, 146, 73);">
                    <strong>Our Menus</strong>
                    <hr />
                </h1>
            
                <div class="row">
                    
                    <div class="col" data-aos="fade-left" data-aos-duration="2000">
                        <div class="owl-carousel menu-carousel owl-theme">
                            @foreach ($menus as $menu)
                            <a href="{{route('menu-view',$menu->name)}}">
                            <div class="card" >
                                     <img src="{{asset('menu_images/'.$menu->image)}}" alt="image"  />
                                 <h3>{{$menu->name}}  </h3>
                                <span >&#8358 {{$menu->price}}</span>
                             </div>
                             @endforeach
                             </a>
                        </div>
                    </div>
                </div><hr>
            </div>

            <!-- our collection -->
            <div class="container py-2">
                <h1 class="text-center py-3" data-aos="fade-left"
                    data-aos-duration="2000" style="color: rgb(175, 146, 73);">
                    <strong>Make Order</strong>
                    <hr />
                </h1>
    
                <div class="row " data-aos="fade-right"
                data-aos-duration="2000" >
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <img
                            src="{{asset('assets/img/fruits.jpg')}}"
                            class="d-block w-100"
                            alt="..."
                            />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="card">
                            <div class="card-body">
                            <div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates eveniet amet atque culpa tempore magni, adipisci, reprehenderit, eum repudiandae recusandae quidem cupiditate earum minus nostrum dolorem error sapiente corporis? Iure!</p>
                            </div>
                        </div>
                    </div><br>
                            <a href="{{route('customer-order')}}"><button class="btn btn-primary btn-block">Make Order</button></a>
                        </div>
                    
                </div><hr>
            </div>
@endsection