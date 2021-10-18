@extends('admin/layout')
@section('title','Weight')
@section('weight_select','active')


@section('container')
@if(session()->has('success'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<h1>Weight</h1>
<br>
<a href="{{ route('weight.create') }}">
    <button type="button" class="btn btn-success">Create Weight</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Weight</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($weights as $weight)
                    <tr>
                        <td>{{ $weight->id }}</td>
                        <td>{{ $weight->weight }}</td>
                        <td>
                            <a class="btn btn-primary text-withe" href="{{ route('weight.edit',$weight->id) }}">Edit</a>

                            @if($weight->status ==1)
                                <a href="{{ url('admin/weight/status/0') }}/{{ $weight->id }}" class="btn btn-success text-withe">Active</a>
                            @elseif($weight->status ==0)
                                <a href="{{ url('admin/weight/status/1') }}/{{ $weight->id }}" class="btn btn-warning text-withe">Deactive</a>
                            @endif
                            <a class="btn btn-danger text-withe" href="{{ route('weight.destroy',$weight->id) }}"
                                onclick="event.preventDefault();
                                    document.getElementById('delete-form-{{ $weight->id }}').submit();">
                                        Delete
                            </a>

                            <form id="delete-form-{{ $weight->id }}" action="{{ route('weight.destroy',$weight->id) }}" method="POST" class="d-none">
                                @method('DELETE')
                                @csrf
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection

