@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>All Contact Message</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">All Message</h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap table-striped">
          <thead class="table-dark">
            <tr>
              <th class="wd-15p">No.</th>
              <th class="wd-15p">Name</th>
              <th class="wd-15p">Email</th>
              <th class="wd-15p">Phone</th>
              <th class="wd-15p">Message</th>
              <th class="wd-20p">Action</th>
            </tr>
          </thead>
          <tbody>
              @php($i=1)
              @foreach ($message as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->phone }}</td>
                    <td>{!! str_limit($row->message,$limit = 20) !!}</td>
                    <td>
                        <a href="{{ route('view.message',$row->id) }}" class="btn btn-sm btn-primary" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    </td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div><!-- table-wrapper -->
    </div><!-- card -->



  </div><!-- sl-pagebody -->

@endsection
