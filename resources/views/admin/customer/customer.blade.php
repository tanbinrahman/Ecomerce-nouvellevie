@extends('admin/layout')
@section('title','Customer')
@section('customer_select','active')

@section('container')

@if(session()->has('success'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<h1>Customer</h1>
<br>
{{-- <a href="{{ route('promo_banner.create') }}">
    <button type="button" class="btn btn-success">Show Customer</button>
</a> --}}


<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th width="5%">Id</th>                        
                        <th width="10%">First Name</th>
                        <th width="10%">Last name</th>
                        <th>Email </th>
                        <th>Mobile </th>
                        <th>District </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->first_name }}</td>
                        <td>{{ $customer->last_name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->Mobile_number }}</td>
                        <td>{{ $customer->district }}</td>
                        <td>
                            <a class="btn btn-primary text-withe" href="{{ route('customer.show',$customer->id) }}">Show</a>

                            @if($customer->status ==1)
                            <a href="{{ url('admin/customer/status/0') }}/{{ $customer->id }}" class="btn btn-success text-withe">Active</a>
                            @elseif($customer->status ==0)
                                <a href="{{ url('admin/customer/status/1') }}/{{ $customer->id }}" class="btn btn-warning text-withe">Deactive</a>
                            @endif


                            {{-- <a class="btn btn-danger text-withe" href="{{ route('promo_banner.destroy',$promotion->id) }}"
                                onclick="event.preventDefault();
                                    document.getElementById('delete-form-{{ $promotion->id }}').submit();">
                                        Delete
                            </a>

                            <form id="delete-form-{{ $promotion->id }}" action="{{ route('promo_banner.destroy',$promotion->id) }}" method="POST" class="d-none">
                                @method('DELETE')
                                @csrf
                            </form> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection

