@extends('frontend.layouts.default')

@section('content')
@include('frontend.includes.menubar')

<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_responsive.css') }}">

<div class="contact_form">
    <div class="container">
        <div class="row">

            <div class="col-5 offset-lg-1">
                <div class="contact_form_title">
                    <h4>Your Order Status</h4>
                </div>

                <div class="progress">
                    @if ($track->status == 0)
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif ($track->status == 1)
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif ($track->status == 2)
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif ($track->status == 3)
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-success" role="progressbar" style="width: 35%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    @else
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    @endif


                </div><br>

                @if ($track->status == 0)
                    <h4 class="text-warning">Note : Your Order is under review</h4>
                @elseif ($track->status == 1)
                    <h4 class="text-primary">Note : Payment accept under process</h4>
                @elseif ($track->status == 2)
                    <h4 class="text-info">Note : Packing Done Handover Process</h4>
                @elseif ($track->status == 3)
                    <h4 class="text-success">Note : Order Complete</h4>
                @else
                    <h4 class="text-danger">Note : Order Canceled</h4>
                @endif


            </div>

            <div class="col-5 offset-lg-1">
                <div class="contact_form_title">
                    <h4>Your Order Details</h4>
                </div>
                <ul class="list-group col-lg-12">
                    <li class="list-group-item"><b>Payment Type :</b><span style="float: right">{{ $track->payment_type }}</span></li>
                    <li class="list-group-item"><b>Transaction ID :</b><span style="float: right">{{ $track->payment_id }}</span></li>
                    <li class="list-group-item"><b>Balance ID :</b><span style="float: right">{{ $track->blnc_transection }}</span></li>
                    <li class="list-group-item"><b>SubTotal :</b><span style="float: right">{{ $track->subtotal }} Tk</span></li>
                    <li class="list-group-item"><b>Shipping :</b><span style="float: right">{{ $track->shipping }} Tk</span></li>
                    <li class="list-group-item"><b>Vat :</b><span style="float: right">{{ $track->vat }} Tk</span></li>
                    <li class="list-group-item"><b>Total :</b><span style="float: right">{{ $track->total }} Tk</span></li>
                    <li class="list-group-item"><b>Month :</b><span style="float: right">{{ $track->month }}</span></li>
                    <li class="list-group-item"><b>Date :</b><span style="float: right">{{ $track->date }}</span></li>
                    <li class="list-group-item"><b>Year:</b><span style="float: right">{{ $track->year }}</span></li>
                </ul>
            </div>

        </div>
    </div>
</div>

@endsection
