@extends('admin/layout')
@section('title','Coupon Edit')
@section('coupon_select','active')
    


@section('container')

<h1 class="mb10">Edit Coupon</h1>
<a href="{{ route('coupon.index') }}">
    <button type="button" class="btn btn-success">All Coupon</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
               
                <div class="card">
                 
                    <div class="card-body">
                        <form action="{{ route('coupon.update',$id) }}" method="post" >
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="title" class="control-label mb-1">Coupon Title</label>
                                        <input id="title" name="title" value="{{ $title }}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('title')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="code" class="control-label mb-1">Coupon Code</label>
                                        <input id="code" name="code" value="{{ $code }}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('code')
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
                                        <label for="value" class="control-label mb-1">Coupon value</label>
                                        <input id="value" name="value" value="{{ $value }}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('value')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="type" class="control-label mb-1">Coupon Type</label>
                                        <select id="type" name="type" class="form-control">
                                            @if($type=="value")
                                                <option selected value="value">Value</option>
                                                <option value="per">Percentage </option>
                                            @elseif($type=="per")
                                                <option  value="value">Value</option>
                                                <option selected value="per">Percentage </option>
                                            @endif
                                        </select>
                                        @error('value')
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
                                        <label for="min_order_amt" class="control-label mb-1">Minimun Order Amount </label>
                                        <input id="min_order_amt" name="min_order_amt" value="{{$min_order_amt}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('min_order_amt')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                    <label for="is_one_time" class="control-label mb-1">Is One Time</label>
                                        <select id="is_one_time" name="is_one_time"  class="form-control"  required>
                                            @if($is_one_time=='1')
                                                <option selected value="1">Yes</option>
                                                <option value="0">No </option>
                                            @else
                                                <option  value="1">Yes</option>
                                                <option selected value="0">No </option> 
                                            @endif
                                        </select> 
                                    </div>
                                </div>
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

