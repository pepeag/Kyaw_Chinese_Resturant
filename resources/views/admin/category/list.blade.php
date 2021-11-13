@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">

        @if(Session::has('categorySuccess'))
        <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
           {{Session::get('categorySuccess')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(Session::has('categoryDelete'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
           {{Session::get('categoryDelete')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(Session::has('categoryUpdate'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
           {{Session::get('categoryUpdate')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">

                  <a class="mr-3" href="{{route('admin#addCategory')}}"><button class="btn btn-sm btn-outline-secondary text-dark">Add Category</button></a>
                  {{-- <a href="{{route('admin#categorDownload')}}"><button class="btn btn-sm btn-success mr-3">Download CSV</button></a> --}}


                </h3>

                <div class="card-tools">
                 {{-- <form action="" method="GET">
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
                 <h4 class="d-inline me-4">Total - {{$category->total()}}</h4>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">

                <table class="table table-hover text-nowrap text-center table-striped">
                  <thead class="table-dark">
                    <tr>
                      <th>ID</th>
                      <th>Category Name</th>
                      <th>Product Count</th>

                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
@foreach ($category as $item )
<tr>
    <td>{{$item->category_id}}</td>
    <td>{{$item->category_name}}</td>
    <td>
        {{-- @if ($item->count==0)
        <a href="#" class="text-decoration-none text-dark" >{{$item->count}}</a>
        @else
            <a href="{{route('admin#categoryItem',$item->category_id)}}" class="text-decoration-none text-dark">{{$item->count}}</a>
        @endif --}}
        1
    </td>
    <td>
        <a href="{{route('admin#editCategory',$item->category_id)}}" class="text-decoration-none">
            <button class="btn btn-sm bg-info text-white mr-2"><i class="fas fa-edit"></i></button>
        </a>
        <a href="{{route('admin#deleteCategory',$item->category_id)}}" class="text-decoration-none">
            <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
        </a>

    </td>
</tr>

@endforeach
                  </tbody>
                </table>
               <div class="mt-4 ms-5">
                {{$category->links()}}
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
