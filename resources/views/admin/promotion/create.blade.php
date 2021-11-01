@extends('admin/layout')
@section('title','Promotional Banner Create')
@section('promotional_select','active')
    


@section('container')

<h1 class="mb10">Create Promotional Banner</h1>
<a href="{{ route('promo_banner.index') }}">
    <button type="button" class="btn btn-success">All Promotional Banner</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
               
                <div class="card">
                 
                    <div class="card-body">
                        <form action="{{ route('promo_banner.store') }}" method="post" enctype="multipart/form-data">
                        
                            @csrf
                            <div class="form-group">
                                <label for="title" class="control-label mb-1">Promotional Banner Title</label>
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
                                        <label for="slug" class="control-label mb-1">Promotional Banner slug</label>
                                        <input id="slug" name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('slug')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="url" class="control-label mb-1">Promotional Banner url</label>
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
                                        <label for="image" class="control-label mb-1">Promotional Banner Image</label>
                                        <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                                        @error('image')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pro_banner_priority" class="control-label mb-1">Promotion Banner Priority</label>
                                        <select id="pro_banner_priority" name="pro_banner_priority" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            <option value="">Select any Priority value</option>
                                            @foreach([1,2,3,4] as $key =>$sm)
                                            <option
                                                value="{{$sm}}">Priority: {{$sm}}</option>
                                             @endforeach
                                        </select>
                                        
                                        @error('pro_banner_priority')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror 
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="category_id" class="control-label mb-1">Select Category</label>
                                <select id="category_id" name="category_id" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                    <option value="">Select any Category</option>
                                    @foreach ($categories as $category)
                                       
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
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
@endsection

