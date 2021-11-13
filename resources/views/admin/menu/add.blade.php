@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-2">
          <div class="col-9 offset-2">
            <div class="col-md-9">
                <a href="{{route('admin#menu')}}" class="text-decoration-none text-dark" >
                    <div class="mb-2"><i class="fas fa-arrow-left text-decoration-none mr-1"></i>Back</div>
                </a>
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Add Menu</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" method="POST" action="{{route('admin#insertMenu')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{old('name')}}"  placeholder="Name">
                            @if($errors->has('name'))
                            <p class="text-danger">{{$errors->first('name')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control" name="image" value="{{old('image')}}"  placeholder="Choose Image">
                              @if($errors->has('image'))
                              <p class="text-danger">{{$errors->first('image')}}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" name="price" value="{{old('price')}}"  placeholder="Price">
                              @if($errors->has('price'))
                              <p class="text-danger">{{$errors->first('price')}}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Publish Status</label>
                            <div class="col-sm-10">
                              <select name="publish" id=""  class="form-control">
                                <option value="">Choose Option</option>
                                  <option value="1">Publish</option>
                                  <option value="0">Unpublish</option>
                              </select>
                              @if($errors->has('publish'))
                              <p class="text-danger">{{$errors->first('publish')}}</p>
                              @endif
                            </div>
                          </div>
                          <div>
                          {{-- <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Discount Price</label>
                            <div class="col-sm-10 mt-2">
                                <input type="number" class="form-control" name="discount" value="{{old('discount')}}" placeholder="Discount">

                              @if($errors->has('discount'))
                              <p class="text-danger">{{$errors->first('discount')}}</p>
                              @endif
                            </div>
                          </div> --}}
                          {{-- <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Buy 1 Get 1</label>
                            <div class="col-sm-10 mt-2">
                              <input type="radio" name="buyOneGetOne" class="form-input-check" value="1">Yes
                              <input type="radio" name="buyOneGetOne" class="form-input-check" value="0">No

                              @if($errors->has('buyOneGetOne'))
                              <p class="text-danger">{{$errors->first('buyOneGetOne')}}</p>
                              @endif
                            </div>
                          </div> --}}
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Waiting Time</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" value="{{old('waitingTime')}}" name="waitingTime">
                              @if($errors->has('waitingTime'))
                              <p class="text-danger">{{$errors->first('waitingTime')}}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                              <textarea name="description" id="" rows="3" class="form-control">{{old('description')}}</textarea>
                              @if($errors->has('description'))
                              <p class="text-danger">{{$errors->first('description')}}</p>
                              @endif
                            </div>
                          </div>


                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white">Add Menu</button>
                          </div>
                        </div>
                      </form>

                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
