@extends('user.layouts.styles')
@section('content')
    
    <section id="" class="">
        <div class="container"  data-aos="fade-up">

          <div class="row mt-5">
            <div class=" mt-5 col-lg-3 order-1 order-lg-2 mt-5 ms-3 me-5" data-aos="zoom-in" data-aos-delay="100">
              <div class="about-img mt-2">
                <img src="{{asset('uploads/'.$menu->image)}}" alt="" style="width:400px">
              </div>
            </div>

            <div class="mt-5 col-lg-7 pt-7 pt-lg-0 order-2 order-lg-1 content me-5">
                <a href="{{route('user#index')}}" >
                    <button class="btn bg-dark text-white mb-4" >
                        <i class="fas fa-backspace"></i> Back
                    </button>
                </a>
              <h4>Name</h4>
              <span>{{$menu->menu_name}}</span>
              <br><hr>
              <h4>Price</h4>
              <span>{{$menu->price}} kyats</span>
              <br><hr>
              <h4>Waiting Time</h4>
              <span>{{$menu->waiting_time}} minutes</span>
              <br><hr>
              <h4>Description</h4>
              <span>{{$menu->description}}</span>
              <br><hr>

<div>
    <a href="{{route('user#order')}}">
        <button class="btn btn-sm text-dark ms-4 mt-2 float-end" style="background-color:springgreen;width:200px;">Order
        <i class="fas fa-shopping-cart" style="color: rgb(30, 95, 21)"></i>
    </button>
</a>
</div>
            </div>

          </div>

        </div>
      </section>
@endsection
