@extends('admin/layout')
@section('title','Unit')
@section('unit_select','active')


@section('container')
@if(session()->has('success'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<h1>Unit</h1>
<br>
<a href="{{ route('unit.create') }}">
    <button type="button" class="btn btn-success">Create Unit</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Unit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $unit)
                    <tr>
                        <td>{{ $unit->id }}</td>
                        <td>{{ $unit->unit }}</td>
                        <td>
                            <a class="btn btn-primary text-withe" href="{{ route('unit.edit',$unit->id) }}">Edit</a>

                            @if($unit->status ==1)
                                <a href="{{ url('admin/unit/status/0') }}/{{ $unit->id }}" class="btn btn-success text-withe">Active</a>
                            @elseif($unit->status ==0)
                                <a href="{{ url('admin/unit/status/1') }}/{{ $unit->id }}" class="btn btn-warning text-withe">Deactive</a>
                            @endif
                            <a class="btn btn-danger text-withe" href="{{ route('unit.destroy',$unit->id) }}"
                                onclick="event.preventDefault();
                                    document.getElementById('delete-form-{{ $unit->id }}').submit();">
                                        Delete
                            </a>

                            <form id="delete-form-{{ $unit->id }}" action="{{ route('unit.destroy',$unit->id) }}" method="POST" class="d-none">
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

