@extends('admin/layout')
@section('title','Shipping details page')
@section('shipping_select','active')


@section('container')
@if(session()->has('success'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<h1>Shipping Details</h1>
<br>
<a href="{{ route('shipping.create') }}">
    <button type="button" class="btn btn-success">Create Shipping Details</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Shipping Address</th>
                        <th>Shipping Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shippings as $shipping)
                    <tr>
                        <td>{{ $shipping->id }}</td>
                        <td>{{ $shipping->shipping_address }}</td>
                        <td>{{ $shipping->shipping_amount }}</td>
                        <td>
                            <a class="btn btn-primary text-withe" href="{{ route('shipping.edit',$shipping->id) }}">Edit</a>

                            @if($shipping->status ==1)
                                <a href="{{ url('admin/shipping/status/0') }}/{{ $shipping->id }}" class="btn btn-success text-withe">Active</a>
                            @elseif($shipping->status ==0)
                                <a href="{{ url('admin/shipping/status/1') }}/{{ $shipping->id }}" class="btn btn-warning text-withe">Deactive</a>
                            @endif
                            <a class="btn btn-danger text-withe" href="{{ route('shipping.destroy',$shipping->id) }}"
                                onclick="event.preventDefault();
                                    document.getElementById('delete-form-{{ $shipping->id }}').submit();">
                                        Delete
                            </a>

                            <form id="delete-form-{{ $shipping->id }}" action="{{ route('shipping.destroy',$shipping->id) }}" method="POST" class="d-none">
                                @method('DELETE')
                                @csrf
                            </form>
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

