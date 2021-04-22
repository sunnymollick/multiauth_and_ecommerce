@extends('admin_backend.layouts.admin_master')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <span class="breadcrumb-item active">Seo Setting</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Seo Setting</h5>
     </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">

    <form action="{{ route('update.seo',$seo->id) }}" method="POST">
    @csrf

    <div class="form-layout">
        <div class="row mg-b-25">
          <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label">Meta Title: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="meta_title" value="{{ $seo->meta_title }}"  required>
              @error('meta_title')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div><!-- col-4 -->
          <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label">Meta Author: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="meta_author" value="{{ $seo->meta_author }}" required>
              @error('meta_author')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div><!-- col-4 -->
          <div class="col-lg-6">
            <div class="form-group">
              <label class="form-control-label">Meta Tag: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="meta_tag" value="{{ $seo->meta_tag }}" required>
              @error('meta_tag')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div><!-- col-4 -->



          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Meta Description: <span class="tx-danger">*</span></label>
              <textarea class="form-control" name="meta_description"  cols="20" rows="10" required>
                    {!! $seo->meta_description !!}
              </textarea>
              @error('meta_description')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Google Analytics: <span class="tx-danger">*</span></label>
              <textarea class="form-control" name="google_analytics" cols="20" rows="10" required>
                {!! $seo->google_analytics !!}
              </textarea>
              @error('google_analytics')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div><!-- col-4 -->

          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Bing Analytics: <span class="tx-danger">*</span></label>
              <textarea class="form-control" name="bing_analytics"  cols="20" rows="10" required>
                {!! $seo->bing_analytics !!}
              </textarea>
              @error('bing_analytics')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div><!-- col-4 -->


        </div>


        <div class="form-layout-footer">
          <button class="btn btn-info mg-r-5">Update SEO</button>
          <button class="btn btn-secondary">Cancel</button>
        </div><!-- form-layout-footer -->
      </div>

    </form>



      <!-- form-layout -->


    </div><!-- card -->

  </div><!-- sl-pagebody -->


<script type="text/javascript">
function readURL(input){
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#one')
      .attr('src', e.target.result)
      .width(80)
      .height(80);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>



@endsection

@section('scripts')




@endsection
