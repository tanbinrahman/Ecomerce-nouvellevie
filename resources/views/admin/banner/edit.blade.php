@extends('admin/layout')
@section('title','Banner Edit')
@section('banner_select','active')
    


@section('container')

<h1 class="mb10">Edit Banner</h1>
<a href="{{ route('banner.index') }}">
    <button type="button" class="btn btn-success">All Banner</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
               
                <div class="card">
                 
                    <div class="card-body">
                        <form action="{{ route('banner.update',$id) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">                              
                                <label for="title" class="control-label mb-1">Banner Title</label>
                                <input id="title" name="title" value="{{ $title }}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                    @error('title')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="slug" class="control-label mb-1">Banner Slug</label>
                                        <input id="slug" name="slug" value="{{ $slug }}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('slug')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="url" class="control-label mb-1">Banner URL</label>
                                        <input id="url" name="url" value="{{ $url }}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('url')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="control-label mb-1">Banner Image</label>
                                <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                                @if($image!='')
                                    <a href="{{ asset('storage/media/banner/'.$image) }}" target="_blank">
                                        <img width="70px" src="{{ asset('storage/media/banner/'.$image) }}" alt="banner image">
                                    </a>

                                @endif
                                @error('image')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                   Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

