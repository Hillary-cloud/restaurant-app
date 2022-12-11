<base href="/public">
@extends('layouts.base')
@section('content')

<div class="container mt-5">
  <h3>Make your orders from our menu list below</h3>
  <div class="row">
    @foreach ($menus as $menu)
    @if ($menu->status == 1)
    <div class="col-lg-3 col-md-3 col-sm-12">
      <a href="{{route('menu-view',$menu->name)}}">
      <div class="card">
        <div class="card-body">
          <img src="/menu_images/{{$menu->image}}" class="img-responsive img-fluid"  alt="">
          <p class="card-text">{{ucfirst($menu->name)}}</p>
            <p class="text-muted">Only &#8358 {{$menu->price}} per plate</p>
        </div>
      </div>
    </a>
    </div>
    @endif
    @endforeach
  </div>
</div>
@endsection