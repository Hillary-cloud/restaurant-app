@extends('layouts.base')
@section('content')
    
            <!-- our collection -->
            <div class="container py-2">
                <h1 class="text-center py-3" data-aos="fade-left"
                    data-aos-duration="2000" style="color: rgb(175, 146, 73);">
                    <strong>Our Menus</strong>
                    <hr />
                </h1>
                <!-- <span class="float-left"><a href="">More Galleries</a></span> -->
                <div class="row">
                    
                    <div class="col" data-aos="fade-left" data-aos-duration="2000">
                        <div class="owl-carousel menu-carousel owl-theme">
                            @foreach ($menus as $menu)
                            <div class="card" >
                                     <img src="{{asset('menu_images/'.$menu->image)}}" alt="image"  />
                                 <h3>{{$menu->name}}  </h3>
                                <span >&#8358 {{$menu->price}}</span>
                             </div>
                             @endforeach
                          
                        </div>
                    </div>
                </div><hr>
            </div>

            <!-- our collection -->
            <div class="container py-2">
                <h1 class="text-center py-3" data-aos="fade-left"
                    data-aos-duration="2000" style="color: rgb(175, 146, 73);">
                    <strong>Make Reservation</strong>
                    <hr />
                </h1>
                <!-- <span class="float-left"><a href="">More Galleries</a></span> -->
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
                                {{-- <form action="">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                <label for="">Emaill</label>
                                                <input type="text" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" >
                                            </div>
                                            </div>
                                            <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" >
                                            </div>
                                            </div>
                                    </div>
                                    <button class="btn btn-primary btn-block">Make Reservation</button>
                                </div>
                            </div>
                            </form> --}}
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