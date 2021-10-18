@extends('admin/layout')
@section('title','Banner')
@section('banner_select','active')

@section('container')

@if(session()->has('success'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<h1>Banner</h1>
<br>
<a href="{{ route('banner.create') }}">
    <button type="button" class="btn btn-success">Create Banner</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Banner Image</th>
                        <th>Banner Title</th>
                        <th>Banner Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                        <td>
                            <img width="100px" src="{{ asset('storage/media/banner/'.$banner->image) }}" alt="banner image">
                        </td>
                        <td>{{ $banner->title }}</td>
                        <td>{{ $banner->slug }}</td>
                        <td>
                            <a class="btn btn-primary text-withe" href="{{ route('banner.edit',$banner->id) }}">Edit</a>

                            @if($banner->status ==1)
                            <a href="{{ url('admin/banner/status/0') }}/{{ $banner->id }}" class="btn btn-success text-withe">Active</a>
                            @elseif($banner->status ==0)
                                <a href="{{ url('admin/banner/status/1') }}/{{ $banner->id }}" class="btn btn-warning text-withe">Deactive</a>
                            @endif


                            <a class="btn btn-danger text-withe" href="{{ route('banner.destroy',$banner->id) }}"
                                onclick="event.preventDefault();
                                    document.getElementById('delete-form-{{ $banner->id }}').submit();">
                                        Delete
                            </a>

                            <form id="delete-form-{{ $banner->id }}" action="{{ route('banner.destroy',$banner->id) }}" method="POST" class="d-none">
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

