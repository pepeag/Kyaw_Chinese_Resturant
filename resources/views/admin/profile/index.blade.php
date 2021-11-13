@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row my-2">
          <div class="col-9 offset-2 mt-3">
            <div class="col-md-9">

              <div class="card">

                <div class="card-header p-2 " style="background: #fb8c00">
                  <legend class="text-center text-dark">Admin Profile</legend>
                </div>
                <div class="card-body">
                    @if (Session::has('updateSuccess'))
                <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                   {{Session::get('updateSuccess')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (Session::has('passwordError'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                   {{Session::get('passwordError')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="" method="POST">
                          @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value={{old('name',$user->name)}} >
                            @if ($errors->has('name'))
                            <p class="text-danger">{{$errors->first('name')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" value={{old('email',$user->email)}} >
                            @if ($errors->has('email'))
                            <p class="text-danger">{{$errors->first('email')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="phone" value="{{old('phone',$user->phone)}}"  >
                              @if ($errors->has('phone'))
                            <p class="text-danger">{{$errors->first('phone')}}</p>
                            @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="address" value="{{old('address',$user->address)}}" >
                              @if ($errors->has('address'))
                            <p class="text-danger">{{$errors->first('address')}}</p>
                            @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <a href="{{route('admin#changePasswordPage',$user->id)}}">
                                    Change Password
                                </a>
                            </div>
                            <!-- Button trigger modal -->

                          </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-outline-dark text-dark bg-info">Update</button>
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
