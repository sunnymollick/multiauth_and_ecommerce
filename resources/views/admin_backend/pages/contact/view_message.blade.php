@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>View Contact Message</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">View Message</h6>

      <div class="table-wrapper">
        <form action="">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" value="{{ $message->name }}">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" value="{{ $message->email }}">
            </div>
            <div class="form-group">
                <label for="">Phone</label>
                <input type="text" class="form-control" value="{{ $message->phone }}">
            </div>
            <div class="form-group">
                <label for="">Message</label>
                <textarea name="" id="" class="form-control" cols="30" rows="10">
                    {!! $message->message !!}
                </textarea>
            </div>
        </form>
      </div><!-- table-wrapper -->
    </div><!-- card -->



  </div><!-- sl-pagebody -->

@endsection
