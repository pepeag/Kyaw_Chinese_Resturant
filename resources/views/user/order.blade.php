@extends('user.layouts.styles')
@section('content')

    <section id="" class="">
        <div class="container"  data-aos="fade-up">


          <div class="row mt-5">
            <div class=" mt-5 col-lg-3 order-1 order-lg-2 mt-5 ms-3 me-5" data-aos="zoom-in" data-aos-delay="100">
              <div class="about-img mt-2">
                <img src="{{asset('uploads/'.$menu->image)}}" alt="" style="width:400px">
              </div>
              <a href="{{route('user#index')}}" >
                <button class="btn bg-dark text-white mt-4" >
                    <i class="fas fa-backspace"></i> Back
                </button>
            </a>

            </div>
            @if(Session::has('totalTime'))
            <div class="alert alert-info alert-dismissible fade show mt-4 ms-2" role="alert" style="width: 60%">
               Order Success ! Please Wait for {{Session::get('totalTime')}} Minutes
               <div class="text-center">
                Total Price = {{Session::get('totalPrice')}} Kyats

               </div>
              <div class="float-end">
                Thank you For Ordering!
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="mt-5 col-lg-7 pt-7 pt-lg-0 order-2 order-lg-1 content me-5">

              <h4>Name</h4>
              <span>{{$menu->menu_name}}</span>
              <br><hr>
              <h4>Price</h4>
              <span>{{$menu->price}} kyats</span>
              <br><hr>
              <form action="{{route('user#placeOrder')}}" method="POST">
                @csrf
             <h5>Menu Count</h5>
             <input type="number" class="form-control" name="menuCount" placeholder="Number of Item ">

               @if($errors->has('menu'))
                                   <small class="text-danger">{{$errors->first('menuCount')}}</small>
                                   @endif
                                   <br><hr>

             <select name="category" id="" class="form-control">
                 <option value="empty">Choose Category</option>
                 @foreach ($category as $item )
                 <option value="{{$item->category_id}}">{{$item->category_name}}</option>

                 @endforeach
                 @if($errors->has('category'))
                                   <small class="text-danger">{{$errors->first('category')}}</small>
                                   @endif
             </select>
             <br><hr>

              <h5>Payment Type</h5>

              <div class="form-check form-check-inline">
               <input class="form-check-input" type="radio" name="paymentType" id="inlineRadio1" value="1">
               <label class="form-check-label" for="inlineRadio1">Credit Card</label>
             </div>
             <div class="form-check form-check-inline">
               <input class="form-check-input" type="radio" name="paymentType" id="inlineRadio2" value="2">
               <label class="form-check-label" for="inlineRadio2">Cash</label>
             </div>
             <br>
             @if($errors->has('paymentType'))
                                   <small class="text-danger">{{$errors->first('paymentType')}}</small>
                                   @endif
             <br>

             <a href="">
                 <button class="btn btn-primary mt-3 float-end"><i class="fas fa-shopping-cart"></i>Place Order</button>
             </a>
            </form>




            </div>

          </div>

        </div>
      </section>
@endsection
