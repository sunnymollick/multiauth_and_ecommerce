@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">

    <div class="sl-page-title">
      <h5>Subscriber List</h5>
    </div><!-- sl-page-title -->



    <div class="card pd-20 pd-sm-40">
        <form method="post" action="{{ route('delete.all.newsletter') }}" >
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" style="float: right">Delete All</button>

                <h6 class="card-body-title">Subscriber List

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
                        @foreach ($newsletters as $key=>$newsletter)
                            <tr>
                                <td>
                                    <input type="checkbox" name="ids[]" value="{{ $newsletter->id }}">
                                    {{ $key +1 }}
                                </td>
                                <td>{{ $newsletter->email }}</td>
                                <td>{{ $newsletter->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('delete.subscriber',$newsletter->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>

        </form>
                </div><!-- table-wrapper -->
                </div><!-- card -->



            </div><!-- sl-pagebody -->



@endsection
