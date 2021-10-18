@extends('admin/layout')
@section('title','category create')
@section('category_select','active')
    


@section('container')

<h1 class="mb10">Create Category</h1>
<a href="{{ route('category.index') }}">
    <button type="button" class="btn btn-success">All Category</button>
</a>

<script src="{{asset('asset/ckeditor.js')}}"></script>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
               
                <div class="card">
                 
                    <div class="card-body">
                        <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="category_name" class="control-label mb-1">Category Name</label>
                                        <input id="category_name" name="category_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('category_name')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                        <input id="category_slug" name="category_slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('category_slug')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="control-label mb-1">Description</label>
                                <textarea id="description" name="description" type="text" class="form-control" aria-required="true" aria-invalid="false" required></textarea>
                                @error('description')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="category_image" class="control-label mb-1">Category Image</label>
                                        <input id="category_image" name="category_image" type="file" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('category_image')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <br>
                                        <label for="is_home" class="control-label mb-1"> Show in Home Page</label>
                                        <input id="is_home" type="checkbox" name="is_home">
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

<script>
    CKEDITOR.replace('description');
</script>
@endsection

