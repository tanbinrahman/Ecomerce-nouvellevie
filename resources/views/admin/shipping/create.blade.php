@extends('admin/layout')
@section('title','Shipping details Create')
@section('shipping_select','active')
    


@section('container')

<h1 class="mb10">Create Shipping details</h1>
<a href="{{ route('shipping.index') }}">
    <button type="button" class="btn btn-success">All Shipping details</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
               
                <div class="card">
                 
                    <div class="card-body">
                        <form action="{{ route('shipping.store') }}" method="post" >
                            @csrf
                            <div class="form-group">
                                <label for="shipping" class="control-label mb-1">Shipping Address</label>
                                <input id="shipping" name="shipping_address"  type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('shipping_address')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="shipping" class="control-label mb-1">Shipping Amount</label>
                                <input id="shipping" name="shipping_amount"  type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('shipping_amount')
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

