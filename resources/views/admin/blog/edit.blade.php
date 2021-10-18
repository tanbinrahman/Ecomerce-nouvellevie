@extends('admin/layout')
@section('title','Blog Edit')
@section('Blog_select','active')
    


@section('container')

<h1 class="mb10">Edit Blog</h1>
<a href="{{ route('blog.index') }}">
    <button type="button" class="btn btn-success">All Blog</button>
</a>

<script src="{{asset('asset/ckeditor.js')}}"></script>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
               
                <div class="card">
                 
                    <div class="card-body">
                        <form action="{{ route('blog.update',$id) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">                              
                                <label for="title" class="control-label mb-1">Blog Title</label>
                                <input id="title" name="title" value="{{ $title }}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                    @error('title')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Blog Slug</label>
                                <input id="slug" name="slug" value="{{ $slug }}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                @error('slug')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image" class="control-label mb-1">Blog Image</label>
                                <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false">
                                @if($image!='')
                                <a href="{{asset('storage/media/blog/'.$image)}}" target="_blank">
                                    <img width="50px" height="50px" src="{{asset('storage/media/blog/'.$image)}}" alt="">
                                </a>
                                 @endif
                                @error('image')
                                    <div class="alert alert-danger">
                                        {{ $message }} 
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description" class="control-label mb-1">Description</label>
                                <textarea name="description" id="description" type="text" class="form-control" aria-required="true" aria-invalid="false">{{ $description }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                   Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('description');
</script>
@endsection

