@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Admin Table</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Admin List
          <a href="{{ route('create.admin') }}" class="btn btn-sm btn-dark" style="float: right" >Add User</a>
      </h6>

      <div class="table-wrapper table-responsive">
        <table id="datatable1" class="table display responsive nowrap table-striped">
          <thead class="table-dark">
            <tr>
              <th class="wd-15p">No.</th>
              <th class="wd-15p">Name</th>
              <th class="wd-15p">Email</th>
              <th class="wd-15p">Access</th>
              <th class="wd-20p">Action</th>
            </tr>
          </thead>
          <tbody>
              @php($i=1)
              @foreach ($user as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>
                        @if ($row->category == 1)
                            <span class="badge badge-danger">Category</span>
                        @else

                        @endif

                        @if ($row->coupon == 1)
                            <span class="badge badge-info">Coupon</span>
                        @else

                        @endif

                        @if ($row->product == 1)
                            <span class="badge badge-primary">Product</span>
                        @else

                        @endif

                        @if ($row->blog == 1)
                            <span class="badge badge-warning">Blog</span>
                        @else

                        @endif

                        @if ($row->order == 1)
                            <span class="badge badge-success">Order</span>
                        @else

                        @endif

                        @if ($row->other == 1)
                            <span class="badge badge-secondary">Other</span>
                        @else

                        @endif

                        @if ($row->report == 1)
                            <span class="badge badge-danger">Report</span>
                        @else

                        @endif

                        @if ($row->role == 1)
                            <span class="badge badge-warning">Role</span>
                        @else

                        @endif

                        @if ($row->return == 1)
                            <span class="badge badge-info">Return</span>
                        @else

                        @endif

                        @if ($row->stock == 1)
                            <span class="badge badge-secondary">Stock</span>
                        @else

                        @endif

                        @if ($row->contact == 1)
                            <span class="badge badge-primary">Contact</span>
                        @else

                        @endif

                        @if ($row->comment == 1)
                            <span class="badge badge-success">Comment</span>
                        @else

                        @endif

                        @if ($row->setting == 1)
                            <span class="badge badge-secondary">Setting</span>
                        @else

                        @endif

                    </td>

                    <td>
                        <a href="{{ route('edit.admin',$row->id) }}" class="btn btn-sm btn-primary" title="Edit Category"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="{{ route('admin.delete',$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div><!-- table-wrapper -->
    </div><!-- card -->



  </div><!-- sl-pagebody -->


@endsection

@section('scripts')



@endsection
