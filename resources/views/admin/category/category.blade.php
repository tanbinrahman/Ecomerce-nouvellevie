@extends('admin/layout')
@section('title','category')
@section('category_select','active')

@section('container')

@if(session()->has('success'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<h1>Category</h1>
<br>
<a href="{{ route('category.create') }}">
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
                        <th>Category Image</th>
                        <th>Category Name</th>
                        <th>Category Slug</th>                       
                        {{-- <th width="10%">Edit</th>
                        <th width="10%">Delete</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            @if($category->category_image!='')
                                <a href="{{asset('storage/media/category/'.$category->category_image)}}" target="_blank">
                                    <img width="50px" height="40px" src="{{asset('storage/media/category/'.$category->category_image)}}" alt="">
                                </a>
                            @endif
                        </td>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->category_slug }}</td>
                        {{-- <td> Edit</td>
                        <td>DELETE</td> --}}
                        <td>
                            <a class="btn btn-primary text-withe" href="{{ route('category.edit',$category->id) }}">Edit</a>

                            @if($category->status ==1)
                            <a href="{{ url('admin/category/status/0') }}/{{ $category->id }}" class="btn btn-success text-withe">Active</a>
                            @elseif($category->status ==0)
                                <a href="{{ url('admin/category/status/1') }}/{{ $category->id }}" class="btn btn-warning text-withe">Deactive</a>
                            @endif


                            <a class="btn btn-danger text-withe" href="{{ route('category.destroy',$category->id) }}"
                                onclick="event.preventDefault();
                                    document.getElementById('delete-form-{{ $category->id }}').submit();">
                                        Delete
                            </a>

                            <form id="delete-form-{{ $category->id }}" action="{{ route('category.destroy',$category->id) }}" method="POST" class="d-none">
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

