@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>{{ date('d-m-y') }} Order Report</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Today Order Report</h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap table-striped">
          <thead class="table-dark">
            <tr>
              <th class="wd-15p">No.</th>
              <th class="wd-15p">Payment Type</th>
              <th class="wd-15p">Transaction ID</th>
              <th class="wd-15p">SubTotal</th>
              <th class="wd-15p">Shipping</th>
              <th class="wd-15p">Vat</th>
              <th class="wd-15p">Total</th>
              <th class="wd-15p">Date</th>
              <th class="wd-15p">Status</th>
              <th class="wd-20p">Action</th>
            </tr>
          </thead>
          <tbody>
              @php($i=1)
              @foreach ($order as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $row->payment_type }}</td>
                    <td>{{ $row->blnc_transection }}</td>
                    <td>{{ $row->subtotal }} Tk</td>
                    <td>{{ $row->shipping }} Tk</td>
                    <td>{{ $row->vat }} Tk</td>
                    <td>{{ $row->total }} Tk</td>
                    <td>{{ $row->date }}</td>
                    <td>
                        @if ($row->status == 0)
                            <span class="badge badge-warning">Pending</span>
                        @elseif ($row->status == 1)
                            <span class="badge badge-info">Payment Accept</span>
                        @elseif ($row->status == 2)
                            <span class="badge badge-warning">Progress</span>
                        @elseif ($row->status == 3)
                            <span class="badge badge-success">Delivered</span>
                        @else
                            <span class="badge badge-danger">Cancel</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('view.order',$row->id) }}" class="btn btn-sm btn-primary" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    </td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div><!-- table-wrapper -->
    </div><!-- card -->



  </div><!-- sl-pagebody -->

@endsection
