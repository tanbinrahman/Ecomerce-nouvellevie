@extends('admin/layout')
@section('title','coupon')
@section('coupon_select','active')


@section('container')

@if(session()->has('success'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<h1>coupon</h1>
<br>
<a href="{{ route('coupon.create') }}">
    <button type="button" class="btn btn-success">Create Category</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Coupon Title</th>
                        <th>Coupon Code</th>
                        <th>Coupon value</th>
                        {{-- <th width="10%">Edit</th>
                        <th width="10%">Delete</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->id }}</td>
                        <td>{{ $coupon->title }}</td>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ $coupon->value }}</td>
                        {{-- <td> Edit</td>
                        <td>DELETE</td> --}}
                        <td>
                            <a class="btn btn-primary text-withe" href="{{ route('coupon.edit',$coupon->id) }}">Edit</a>

                            @if($coupon->status ==1)
                                <a href="{{ url('admin/coupon/status/0') }}/{{ $coupon->id }}" class="btn btn-success text-withe">Active</a>
                            @elseif($coupon->status ==0)
                                <a href="{{ url('admin/coupon/status/1') }}/{{ $coupon->id }}" class="btn btn-warning text-withe">Deactive</a>
                            @endif
                            <a class="btn btn-danger text-withe" href="{{ route('coupon.destroy',$coupon->id) }}"
                                onclick="event.preventDefault();
                                    document.getElementById('delete-form-{{ $coupon->id }}').submit();">
                                        Delete
                            </a>

                            <form id="delete-form-{{ $coupon->id }}" action="{{ route('coupon.destroy',$coupon->id) }}" method="POST" class="d-none">
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

