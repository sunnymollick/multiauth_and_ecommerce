@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Subscriber List</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Subscriber List
          <button class="btn btn-sm btn-dark" style="float: right" data-toggle="modal" data-target="#modaldemo3">Delete All</button>
      </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap table-striped">
          <thead class="table-dark">
            <tr>
              <th class="wd-15p">No.</th>
              <th class="wd-15p">Email</th>
              <th class="wd-15p">Subscribing Time</th>
              <th class="wd-20p">Action</th>
            </tr>
          </thead>
          <tbody>
              @php($i=1)
              @foreach ($newsletters as $newsletter)
                <tr>
                    <td>
                        <input type="checkbox" name="" id="">
                        {{ $i++ }}</td>
                    <td>{{ $newsletter->email }}</td>
                    <td>{{ $newsletter->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('delete.subscriber',$newsletter->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                    </td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div><!-- table-wrapper -->
    </div><!-- card -->



  </div><!-- sl-pagebody -->









   {{-- <!-- LARGE MODAL -->
   <div id="modaldemo3" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Coupon</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ route('store.coupon') }}">
            @csrf
            <div class="modal-body pd-20">

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Coupon Code</label>
                  <input type="text" class="form-control" name="coupon" placeholder="Coupon Code" id="coupon" value="{{ old('coupon') }}" required>
                  @error('coupon')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Coupon Discount (%)</label>
                    <input type="text" class="form-control" name="discount" placeholder="Coupon discount" id="discount" value="{{ old('discount') }}" required>
                    @error('discount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <button type="submit" class="btn btn-info pd-x-20">Add Coupon</button>
                </div>


    </form>
      </div>
    </div><!-- modal-dialog -->
  </div><!-- modal --> --}}

@endsection
