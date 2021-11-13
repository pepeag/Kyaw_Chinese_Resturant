@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">

                  <h4 class="d-inline">Total - {{$contact->total()}}</h4>
                </h3>

                <div class="card-tools">
                 <form action="{{route('admin#contactSearch')}}" method="GET">
                     @csrf
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="searchData" value="{{old('searchData')}}" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                 </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">

                <table class="table table-hover text-nowrap text-center table-striped">
                  <thead class="table-dark">
                    <tr>
                      <th>User ID</th>
                      <th>User Name</th>
                      <th>Email</th>
                      <th>Message</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($status==0)
                    <tr>
                         <td colspan="4"><small class="text-muted">There is no data</small></td>
                    </tr>

                     @else
@foreach ($contact as $item )
<tr>
    <td>{{$item->user_id}}</td>
    <td>{{$item->name}}</td>
    <td>
       {{$item->email}}
    </td>
    <td>{{$item->message}}</td>

    {{-- <td>
        <a href="{{route('admin#editCategory',$item->category_id)}}">
            <button class="btn btn-sm bg-dark text-white mr-2"><i class="fas fa-edit"></i></button>
        </a>
        <a href="{{route('admin#deleteCategory',$item->category_id)}}">
            <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
        </a>

    </td> --}}
</tr>

@endforeach
@endif
                  </tbody>
                </table>
               <div class="mt-4 ms-5">
                {{$contact->links()}}
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
