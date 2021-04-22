@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>All Post</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Post List
          <a href="{{ route('add.blog.post') }}" class="btn btn-dark" style="float: right">Add Post</a>
      </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap table-striped">
          <thead class="table-dark">
            <tr>
              <th>No.</th>
              <th>Post Title</th>
              <th>Category</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @php($i=1)
              @foreach ($posts as $post)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $post->post_title_en }}</td>
                    <td>{{ $post->category }}</td>
                    <td><img src="{{ asset($post->post_image) }}" height="70px" width="80px" alt=""></td>
                    <td>
                        <a href="{{ route('view.blog.post',$post->id) }}" class="btn btn-sm btn-secondary" title="View Post"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a href="{{ route('edit.blog.post',$post->id) }}" class="btn btn-sm btn-primary" title="Edit Post"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="{{ route('delete.blog.post',$post->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

