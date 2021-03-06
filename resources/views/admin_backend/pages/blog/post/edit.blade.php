@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Blog Post Update</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Blog Post</h6>

    <form action="{{ route('blog.post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Product Title (English): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="post_title_en" value="{{ $post->post_title_en }}" required>
                  @error('post_title_en')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Post Title (Bangla): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="post_title_in" value="{{ $post->post_title_in }}" required>
                  @error('post_title_in')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Blog Category (English): <span class="tx-danger">*</span></label>
                  <select class="form-control select2" id="category" data-placeholder="Choose Category" name="category_id" required>
                    <option label="Choose Category"></option>
                    @foreach ($blogcats as $blogcat)
                        <option value="{{ $blogcat->id }}"
                            @if ($blogcat->id == $post->category_id)
                                selected
                            @endif
                        >{{ $blogcat->category_name_en }}</option>
                    @endforeach
                  </select>
                </div>
              </div><!-- col-4 -->


              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Post Details (English): <span class="tx-danger">*</span></label>
                  <textarea class="form-control" name="details_en" id="editor" cols="30" rows="10" required>
                        {!! $post->details_en !!}
                  </textarea>
                  @error('details_en')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Post Details (Bangla): <span class="tx-danger">*</span></label>
                  <textarea class="form-control" name="details_in" id="editor1" cols="30" rows="10" required>
                         {!! $post->details_in !!}
                  </textarea>
                  @error('details_in')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Post Image: <span class="tx-danger">*</span></label>
                  <label class="custom-file">
                    <input type="file" id="file" class="custom-file-input" onchange="readURL(this);" name="post_image">
                    <span class="custom-file-control"></span>
                    <img src="#" id="one" alt="">
                  </label>
                @error('post_image')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Old Post Image: <span class="tx-danger">*</span></label>
                  <img src="{{ asset($post->post_image) }}" height="80px" width="120px" alt="Post Image">
                </div>
              </div><!-- col-4 -->


            </div>


            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5">Update</button>
            </div><!-- form-layout-footer -->
          </div>

        </form>



    </div><!-- card -->

  </div><!-- sl-pagebody -->

  <script type="text/javascript">
    function readURL(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#one')
          .attr('src', e.target.result)
          .width(120)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
    </script>

@endsection
