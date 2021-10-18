@extends('admin/layout')
@section('title','Show Customer Details')
@section('customer_select','active')

@section('container')

<h1>Customer Details</h1>
<br>
<a href="{{ route('customer.index') }}">
    <button type="button" class="btn btn-success">All Customer</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Field</th>                        
                        <th>Value</th>
                       
                    </tr>
                </thead>
                <tbody>               
                    <tr>
                        <td><strong>ID</strong></td>
                        <td>{{ $id }}</td>                      
                    </tr>
                    <tr>
                        <td><strong>First Name</strong></td>
                        <td>{{ $first_name }}</td>                      
                    </tr>
                    <tr>
                        <td><strong>Last Name</strong></td>
                        <td>{{ $last_name }}</td>                      
                    </tr>
                    <tr>
                        <td><strong>Mobile Number</strong></td>
                        <td>{{ $Mobile_number }}</td>                      
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>{{ $email }}</td>                      
                    </tr>
                    <tr>
                        <td><strong>Street Address</strong></td>
                        <td>{{ $street_address }}</td>                      
                    </tr>
                    <tr>
                        <td><strong>Town</strong></td>
                        <td>{{ $town }}</td>                      
                    </tr>
                    <tr>
                        <td><strong>District</strong></td>
                        <td>{{ $district }}</td>                      
                    </tr>
                    <tr>
                        <td><strong>Post Code</strong></td>
                        <td>{{ $post_code }}</td>                      
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection

