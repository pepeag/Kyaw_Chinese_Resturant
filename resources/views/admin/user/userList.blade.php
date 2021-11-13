@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">

        @if(Session::has('deleteSuccess'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
           {{Session::get('deleteSuccess')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">

                    <a class="mr-3" href="{{route('admin#userList')}}"><button class="btn btn-sm btn-secondary text-white" >User List</button></a>
                    <a class="mr-3" href="{{route('admin#adminList')}}"><button class="btn btn-sm btn-primary text-white">Admin List</button></a>

                    <h4 class="float-end me-5">Total - {{$user->total()}} </h4>
                </h3>



                <div class="card-tools">
                 {{-- <form action="{{route('admin#userSearch')}}" method="GET">
                     @csrf
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="searchData" value="{{old('searchData')}}" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                 </form> --}}
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">

                <table class="table table-hover text-nowrap text-center table-striped">
                  <thead class="table-dark">
                    <tr>
                      <th>ID</th>
                      <th>User Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>

                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
@if ($status)
@foreach ($user as $item )
@if ($item->role != 'admin')
<tr>
    <td>{{$item->id}}</td>
    <td>{{$item->name}}</td>
    <td>{{$item->email}}</td>
    <td>{{$item->phone}}</td>
    <td>{{$item->address}}</td>
    <td>

        <a href="{{route('admin#userDelete',$item->id)}}">
            <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
        </a>

    </td>
</tr>
@endif

@endforeach
@else
<tr>
    <td colspan="5"><small class="text-muted">There is no data</small></td>
</tr>
@endif
                  </tbody>
                </table>
               <div class="mt-4 ms-5">
                {{$user->links()}}
               </div>
               {{-- <h1>total- {{$user->total()}}</h1> --}}

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 @endsection
