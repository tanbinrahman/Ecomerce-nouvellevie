@extends('admin/layout')
@section('title','Blog')
@section('blog_select','active')

@section('container')

@if(session()->has('success'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<h1>Blog</h1>
<br>
<a href="{{ route('blog.create') }}">
    <button type="button" class="btn btn-success">Create Blog</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th width="5%">Id</th>
                        <th width="10%">Blog Title</th>
                        <th width="10%">Blog Image</th>
                        <th width="40%">Blog Description</th>
                        <th width="30%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>{{Str::limit($blog->title, $limit = 40, ' ...')}}</td>
                        <td>
                            <img width="100px" src="{{ asset('storage/media/blog/'.$blog->image) }}" alt="blog image">
                        </td>

                        <td>{{Str::limit($blog->description, $limit = 100, ' ...')}}</td>
                        <td>
                            <a class="btn btn-primary text-withe" href="{{ route('blog.edit',$blog->id) }}">Edit</a>

                            @if($blog->status ==1)
                            <a href="{{ url('admin/blog/status/0') }}/{{ $blog->id }}" class="btn btn-success text-withe">Active</a>
                            @elseif($blog->status ==0)
                                <a href="{{ url('admin/blog/status/1') }}/{{ $blog->id }}" class="btn btn-warning text-withe">Deactive</a>
                            @endif


                            <a class="btn btn-danger text-withe" href="{{ route('blog.destroy',$blog->id) }}"
                                onclick="event.preventDefault();
                                    document.getElementById('delete-form-{{ $blog->id }}').submit();">
                                        Delete
                            </a>

                            <form id="delete-form-{{ $blog->id }}" action="{{ route('blog.destroy',$blog->id) }}" method="POST" class="d-none">
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

