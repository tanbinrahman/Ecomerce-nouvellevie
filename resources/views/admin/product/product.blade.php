@extends('admin/layout')
@section('title','Product')
@section('product_select','active')

@section('container') 

@if(session()->has('success'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<h1>Product</h1>
<br>
<a href="{{ route('product.create') }}">
    <button type="button" class="btn btn-success">Create Product</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        {{-- <th width="10%">Edit</th>
                        <th width="10%">Delete</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->slug }}</td>
                        <td>
                            @if($product->image!="")
                                <img width="70px" src="{{ asset('storage/media/product/'.$product->image) }}" alt="">
                            @endif
                        </td>
                        {{-- <td> Edit</td>
                        <td>DELETE</td> --}}
                        <td>
                            <a class="btn btn-primary text-withe" href="{{ route('product.edit',$product->id) }}">Edit</a>

                            @if($product->status ==1)
                            <a href="{{ url('admin/product/status/0') }}/{{ $product->id }}" class="btn btn-success text-withe">Active</a>
                            @elseif($product->status ==0)
                                <a href="{{ url('admin/product/status/1') }}/{{ $product->id }}" class="btn btn-warning text-withe">Deactive</a>
                            @endif


                            <a class="btn btn-danger text-withe" href="{{ route('product.destroy',$product->id) }}"
                                onclick="event.preventDefault();
                                    document.getElementById('delete-form-{{ $product->id }}').submit();">
                                        Delete
                            </a>

                            <form id="delete-form-{{ $product->id }}" action="{{ route('product.destroy',$product->id) }}" method="POST" class="d-none">
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

