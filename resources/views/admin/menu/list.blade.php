@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">

        @if(Session::has('menuSuccess'))
        <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
           {{Session::get('menuSuccess')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(Session::has('menuDelete'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
           {{Session::get('menuDelete')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(Session::has('updateMenu'))
        <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
           {{Session::get('updateMenu')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- @if(Session::has('categoryUpdate'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
           {{Session::get('categoryUpdate')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif --}}

        <div class="row mt-3">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">

                  <a class="mr-5" href="{{route('admin#addMenu')}}"><button class="btn btn btn-outline-success btn-secondary text-dark"><b>ADD MENU   </b>  <i class="fas fa-plus"></i></button></a>
                  {{-- <a href="{{route('admin#categorDownload')}}"><button class="btn btn-sm btn-success mr-3">Download CSV</button></a> --}}
                  <h4 class="float-end me-5">Total - {{$menu->total()}}</h4>

                </h3>

                <div class="card-tools">
                 {{-- <form action="" method="GET">
                     @csrf
                    <div class="input-group input-group-sm mt-1" style="width: 150px;">
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
                      <th>Image</th>
                      <th>Menu</th>
                      <th>Price</th>
                      <th>Publish Status</th>

                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($status==0)
                    <tr>
                         <td colspan="7"><small class="text-muted">There is no data</small></td>
                    </tr>

                     @else
@foreach ($menu as $item )
<tr>
    <td>{{$item->menu_id}}</td>
    <td>
        <img src="{{asset('uploads/'.$item->image)}}" alt="" class="img-thumbnail" width="100px">
    </td>
    <td>{{$item->menu_name}}</td>
    <td>{{$item->price}} kyats</td>

    <td>
@if ($item->public_status == 0)
Publish
@elseif ($item->public_status==1)
Unpublish

@endif
    </td>
    <td>
        <a href="{{route('admin#editMenu',$item->menu_id)}}" class="text-decoration-none">
            <button class="btn btn-sm bg-info text-white mr-2"><i class="fas fa-edit"></i></button>
        </a>
        <a href="{{route('admin#deleteMenu',$item->menu_id)}}" class="text-decoration-none">
            <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
        </a>

    </td>
</tr>

@endforeach
@endif
                  </tbody>
                </table>
               <div class="mt-4 ms-5">
                {{$menu->links()}}
               </div>
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
