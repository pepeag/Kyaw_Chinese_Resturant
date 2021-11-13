@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">


      <div class="container-fluid">
        <h3 class="pt-2"></h3>

        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">

                  <h4 class="d-inline">Total Price List</h4>
                </h3>
                <div class="card-tools">
                 <form action="{{route('admin#totalSearch')}}" method="GET">
                     @csrf
                    <div class="input-group input-group-sm me-2" style="width: 200px;">
                        <input type="date" name="searchDate" value="{{old('searchDate')}}" class="form-control float-right my-2" placeholder="Search">

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
                      <th>Customer Name</th>
                      <th>Menu Count</th>
                      <th>Total Price</th>
                      <th>Order Date</th>

                    </tr>
                  </thead>
                  <tbody>
@if($status!=0)
@foreach ($total as $item )

<tr>
   <td>{{$item->customer_name}}</td>
   <td>{{$item->count}}</td>
    <td>{{$item->total}}</td>
    <td>{{$item->order_time}}</td>

</tr>

@endforeach


<div class=" d-inline fs-5 me-5 my-2 float-end"><b>Total Amount-</b> {{$total->sum('total')}} kyats</div>
{{-- total from DB as total --}}
<p class="d-inline fs-5 me-5 my-2 float-end">
   <b> Order Row Total - {{$total->total()}}</b>
</p>
@else
<tr>
     <td colspan="7"><small class="text-muted">There is no data</small></td>
</tr>
@endif
                  </tbody>
                </table>

               <div class="mt-4 ms-5">
                {{$total->links()}}
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


