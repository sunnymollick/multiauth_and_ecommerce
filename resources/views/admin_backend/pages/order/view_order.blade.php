@extends('admin_backend.layouts.admin_master')
@section('content')

  <div class="sl-pagebody">

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Order Details</h6>


    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center text-dark"><span>Order</span> Details</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Name : </th>
                            <th>{{ $order->name }} </th>
                        </tr>

                        <tr>
                            <th>Payment Type : </th>
                            <th>{{ $order->payment_type }}</th>
                        </tr>

                        <tr>
                            <th>Payment ID : </th>
                            <th> {{ $order->payment_id }}</th>
                        </tr>

                        <tr>
                            <th>Total : </th>
                            <th>{{ $order->total }} Tk</th>
                        </tr>

                        <tr>
                            <th>Month : </th>
                            <th>{{ $order->month }}</th>
                        </tr>

                        <tr>
                            <th>Date : </th>
                            <th>{{ $order->date }}</th>
                        </tr>

                    </table>
                </div>




            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center text-dark"><span>Shipping</span> Details</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Name : </th>
                            <th>{{ $shipping->ship_name }} </th>
                        </tr>

                        <tr>
                            <th>Phone : </th>
                            <th>{{ $shipping->ship_phone }} </th>
                        </tr>

                        <tr>
                            <th>Email: </th>
                            <th>{{ $shipping->ship_email }}</th>
                        </tr>

                        <tr>
                            <th>Address : </th>
                            <th> {{ $shipping->ship_address }}</th>
                        </tr>

                        <tr>
                            <th>City : </th>
                            <th>{{ $shipping->ship_city }}</th>
                        </tr>

                        <tr>
                            <th>Status : </th>
                            <th>
                                @if ($order->status == 0)
                                    <span class="badge badge-warning">Pending</span>
                                @elseif ($order->status == 1)
                                    <span class="badge badge-info">Payment Accept</span>
                                @elseif ($order->status == 2)
                                    <span class="badge badge-warning">Progress</span>
                                @elseif ($order->status == 3)
                                    <span class="badge badge-success">Delivered</span>
                                @else
                                    <span class="badge badge-danger">Cancel</span>
                                @endif
                            </th>
                        </tr>

                    </table>
                </div>




            </div>
        </div>
    </div>

    <div class="row">
        <div class="card pd-20 pd-sm-40 col-lg-12">
            <h6 class="card-body-title">Product Details</h6>

            <div class="table-wrapper">
              <table class="table display responsive nowrap table-striped">
                <thead class="table-dark">
                  <tr>
                    <th>No.</th>
                    <th>product ID</th>
                    <th>product Name</th>
                    <th>Image</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach ($orderDetails as $row)
                      <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $row->product_code }}</td>
                          <td>{{ $row->product_name }}</td>
                          <td><img src="{{ asset($row->image_one) }}" height="70px" width="80px" alt=""></td>
                          <td>{{ $row->color }}</td>
                          <td>{{ $row->size }}</td>
                          <td>{{ $row->quantity }}</td>
                          <td>{{ $row->singleprice }} Tk</td>
                          <td>{{ $row->totalprice }} Tk</td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
            </div><!-- table-wrapper -->
          </div><!-- card -->
    </div>

@if ($order->status == 0)
    <a href="{{ route('admin.payment.accept',$order->id) }}" class="btn btn-info">Payment Accept</a>
    <a href="{{ route('admin.payment.cancel',$order->id) }}" class="btn btn-danger">Cancel Order</a>
@elseif ($order->status == 1)
    <a href="{{ route('admin.delivery.process',$order->id) }}" class="btn btn-info">Process Delivery</a>
@elseif ($order->status == 2)
    <a href="{{ route('admin.delivery.done',$order->id) }}" class="btn btn-success">Delivery Done</a>
@elseif ($order->status == 4)
    <span class="text-danger text-center"><h3>This Order is not valid </h3></span>
@else
    <span class="text-success text-center"><h3>This Order is successfully Delivered</h3></span>
@endif




    </div>

  </div>

  @endsection
