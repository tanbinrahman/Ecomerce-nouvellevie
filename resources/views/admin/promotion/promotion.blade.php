@extends('admin/layout')
@section('title','Promotional')
@section('promotional_select','active')

@section('container')

@if(session()->has('success'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<h1>Promotional Banner</h1>
<br>
<a href="{{ route('promo_banner.create') }}">
    <button type="button" class="btn btn-success">Create Promotional Banner</button>
</a>


<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Id</th>                        
                        <th>Promotional Image</th>
                        <th>Title</th>
                        <th>Slug </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promotionals as $promotion)
                    <tr>
                        <td>{{ $promotion->id }}</td>
                        <td>
                            <img height="70px" width="70px" src="{{ asset('storage/media/promo_banner/'.$promotion->image) }}" alt="banner image">
                        </td>
                        <td>{{ $promotion->title }}</td>
                        <td>{{ $promotion->slug }}</td>
                        <td>
                            <a class="btn btn-primary text-withe" href="{{ route('promo_banner.edit',$promotion->id) }}">Edit</a>

                            @if($promotion->status ==1)
                            <a href="{{ url('admin/promo_banner/status/0') }}/{{ $promotion->id }}" class="btn btn-success text-withe">Active</a>
                            @elseif($promotion->status ==0)
                                <a href="{{ url('admin/promo_banner/status/1') }}/{{ $promotion->id }}" class="btn btn-warning text-withe">Deactive</a>
                            @endif


                            <a class="btn btn-danger text-withe" href="{{ route('promo_banner.destroy',$promotion->id) }}"
                                onclick="event.preventDefault();
                                    document.getElementById('delete-form-{{ $promotion->id }}').submit();">
                                        Delete
                            </a>

                            <form id="delete-form-{{ $promotion->id }}" action="{{ route('promo_banner.destroy',$promotion->id) }}" method="POST" class="d-none">
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

