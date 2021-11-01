@extends('admin/layout')
@section('title','dashboard')
@section('dashboard_select','active')


@section('container')
    <div class="row">
       
        <h1>Deshboard</h1>
        
    </div>  
    <br>
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c1">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            {{-- <i class="zmdi zmdi-account-o"></i> --}}
                            <i class="fab fa-product-hunt"></i>
                        </div>
                        <br>
                        <div class="text">
                            <h2>{{ $count_product }}</h2>
                            <span>Total Product</span>
                        </div>
                    </div>
                    {{-- <div class="overview-chart">
                        <canvas id="widgetChart1"></canvas>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c2">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            {{-- <i class="zmdi zmdi-shopping-cart"></i> --}}
                            <i class="fas fa-list"></i>
                        </div>
                        <br>
                        <div class="text">
                            <h2>{{ $count_categories }}</h2>
                            <span>Total Category</span>
                        </div>
                    </div>
                    {{-- <div class="overview-chart">
                        <canvas id="widgetChart2"></canvas>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c3">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        
                        <div class="icon">
                            {{-- <i class="zmdi zmdi-calendar-note"></i> --}}
                            <i class="fas fa-dolly"></i>
                        </div>
                        <br>
                        <div class="text">
                            <h2>{{ $count_orders }}</h2>
                            <span>Total Order</span>
                        </div>
                    </div>
                    {{-- <div class="overview-chart">
                        <canvas id="widgetChart3"></canvas>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c4">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-money"></i>
                        </div>
                        <br>
                        <div class="text">
                            <h2>৳ {{ $Total_earn }}</h2>
                            <span>total earnings</span>
                        </div>
                    </div>
                    {{-- <div class="overview-chart">
                        <canvas id="widgetChart4"></canvas>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>


<br>
<h1>Recent Order</h1>
{{-- <br> --}}

<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Customer Details</th>
                        <th>Amount</th>
                        <th>Order Status</th>
                        <th>Payment Status</th>
                        <th>Order Date</th>
                        <th>Order Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            {{$order->first_name }}{{'  '. $order->last_name  }} <br>
                            {{ $order->eamil }} <br>
                            {{ $order->mobile }} <br>
                            {{ $order->address }},{{ $order->town }},
                            {{ $order->district }},{{ $order->post_code }}
                        
                        </td>
                        <td>{{ $order->total_amount }}</td>
                        <td>{{ $order->orders_status }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->added_on }}</td>
                        <td><a class="btn btn-success text-withe" href="{{ route('orders_details',$order->id) }}" >Click Here</a></td>
                        {{-- <td></td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div class="pagination justify-content-center">
            {{$orders->links()}}
        </div> --}}
        <!-- END DATA TABLE-->
    </div>
</div>

@endsection

