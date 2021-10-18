@extends('admin/layout')
@section('title','Weight Create')
@section('weight_select','active')
    


@section('container')

<h1 class="mb10">Create Weight</h1>
<a href="{{ route('weight.index') }}">
    <button type="button" class="btn btn-success">All Weight</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
               
                <div class="card">
                 
                    <div class="card-body">
                        <form action="{{ route('weight.store') }}" method="post" >
                            @csrf
                            <div class="form-group">
                                <label for="weight" class="control-label mb-1">Weight</label>
                                <input id="weight" name="weight"  type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('weight')
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

