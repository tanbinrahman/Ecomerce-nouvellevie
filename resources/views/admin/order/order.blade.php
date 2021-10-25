@extends('admin/layout')
@section('title','Order page')
@section('order_select','active')

@section('container') 
<h1>Order</h1>
<br>



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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination justify-content-center">
            {{$orders->links()}}
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>


@endsection