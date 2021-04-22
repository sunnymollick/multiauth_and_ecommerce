@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>All Products</h5>
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Product List
          <a href="{{ route('admin.add.product') }}" class="btn btn-dark" style="float: right">Add Product</a>
      </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap table-striped">
          <thead class="table-dark">
            <tr>
              <th>No.</th>
              <th>product Name</th>
              <th>product Code</th>
              <th>Image</th>
              <th>Category</th>
              <th>Brand</th>
              <th>Quantity</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @php($i=1)
              @foreach ($products as $product)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_code }}</td>
                    <td><img src="{{ asset($product->image_one) }}" height="70px" width="80px" alt=""></td>
                    <td>{{ $product->category_name }}</td>
                    <td>{{ $product->brand_name }}</td>
                    <td>{{ $product->product_quantity }}</td>
                    <td>
                        @if ($product->status == 1)
                          <a href="{{ route('inactive.product',$product->id) }}" class="btn btn-sm btn-success" title="Click To Inactive"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></a>
                        @else
                          <a href="{{ route('active.product',$product->id) }}" class="btn btn-sm btn-danger" title="Click To Active"><i class="fa fa-power-off" aria-hidden="true"></i></a>

                        @endif
                    </td>
                    <td>
                        <a href="{{ route('view.product',$product->id) }}" class="btn btn-sm btn-secondary" title="View Product"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a href="{{ route('edit.product',$product->id) }}" class="btn btn-sm btn-primary" title="Edit Product"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="{{ route('delete.product',$product->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

