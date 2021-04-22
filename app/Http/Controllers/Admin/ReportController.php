<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Web\Order;

class ReportController extends Controller{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function todayOrder(){
        $today = date('d-m-y');
        $order = Order::where('status',0)->where('date',$today)->get();
        return view('admin_backend.pages.report.today_order',['order'=>$order]);
    }

    public function todayDelivery(){
        $today = date('d-m-y');
        $order = Order::where('status',3)->where('date',$today)->get();
        return view('admin_backend.pages.report.today_delivery',['order'=>$order]);
    }

    public function thisMonth(){
        $month = date('F');
        $order = Order::where('status',3)->where('month',$month)->get();
        return view('admin_backend.pages.report.this_month',['order'=>$order]);
    }

    public function search(){
        return view('admin_backend.pages.report.search');
    }

    public function searchByYear(Request $request){
        $year = $request->year;
        $order = Order::where('status',3)->where('year',$year)->get();
        $total = Order::where('status',3)->where('year',$year)->sum('total');
        return view('admin_backend.pages.report.search_year',['order'=>$order,'total'=>$total]);
    }

    public function searchByMonth(Request $request){
        $month = $request->month;
        $order = Order::where('status',3)->where('month',$month)->get();
        $total = Order::where('status',3)->where('month',$month)->sum('total');
        return view('admin_backend.pages.report.search_month',['order'=>$order,'total'=>$total]);
    }

    public function searchByDate(Request $request){
        $date = $request->date;
        $newdate = date('d-m-y',strtotime($date));
        $order = Order::where('status',3)->where('date',$newdate)->get();
        $total = Order::where('status',3)->where('date',$newdate)->sum('total');
        return view('admin_backend.pages.report.search_date',['order'=>$order,'total'=>$total]);
    }

}
