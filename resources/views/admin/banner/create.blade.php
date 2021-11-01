@extends('admin/layout')
@section('title','Banner create')
@section('banner_select','active')
    


@section('container')

<h1 class="mb10">Create Banner</h1>
<a href="{{ route('banner.index') }}">
    <button type="button" class="btn btn-success">All Banner</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
               
                <div class="card">
                 
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">                              
                                <label for="title" class="control-label mb-1">Banner Title</label>
                                <input id="title" name="title" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
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
                                        <input id="slug" name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('slug')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="url" class="control-label mb-1">Banner URL</label>
                                        <input id="url" name="url" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('url')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="image" class="control-label mb-1">Banner Image</label>
                                        <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('image')
                                            <div class="alert alert-danger">
                                                {{ $message }} 
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="banner_priority" class="control-label mb-1">Banner Priority</label>
                                        <select id="banner_priority" name="banner_priority" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            <option value="">Select any Priority value</option>
                                            @foreach([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52] as $key =>$sm)
                                            <option
                                                value="{{$sm}}">Priority: {{$sm}}</option>
                                             @endforeach
                                        </select>
                                        
                                        @error('banner_priority')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

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
@endsection

