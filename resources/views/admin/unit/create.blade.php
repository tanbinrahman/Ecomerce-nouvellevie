@extends('admin/layout')
@section('title','Unit Create')
@section('unit_select','active')
    


@section('container')

<h1 class="mb10">Create Unit</h1>
<a href="{{ route('unit.index') }}">
    <button type="button" class="btn btn-success">All Unit</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
               
                <div class="card">
                 
                    <div class="card-body">
                        <form action="{{ route('unit.store') }}" method="post" >
                            @csrf
                            <div class="form-group">
                                <label for="unit" class="control-label mb-1">Unit</label>
                                <input id="unit" name="unit"  type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('unit')
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

