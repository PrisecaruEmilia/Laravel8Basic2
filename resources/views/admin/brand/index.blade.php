{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-flex justify-content-between">
            <b>All Brands</b>
            <b><span class="badge badge-danger"></span></b>
        </h2>
    </x-slot> --}}
@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
       <div class="container">
           <div class="row">
               <div class="col-md-8">
                   <div class="card">
                       {{-- @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif --}}
                       <div class="card-header">
                           All Brands
                       </div>
                       <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <th scope="row"># {{ $brands->firstItem()+$loop->index }}</th>
                                            <td>{{ $brand->brand_name }}</td>
                                            <td><img src="{{ asset($brand->brand_image) }}" alt="{{ $brand->brand_name }}" style="height:70px; width:70px;"></td>
                                            <td>
                                                @if($brand->created_at == null)
                                                    <span class="text-danger">No Date Set</span>
                                                @else
                                                {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ url('brand/delete/'.$brand->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $brands->links('pagination::bootstrap-4') }}
                       </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Brand
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                  <label for="brand_name">Brand Name</label>
                                  <input type="text" name="brand_name" class="form-control" id="brand_name" aria-describedby="emailHelp">
                                  @error('brand_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                  @enderror
                                </div>
                                <div class="form-group">
                                    <label for="brand_image">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="brand_image" aria-describedby="emailHelp">
                                    @error('brand_image')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                  </div>
                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
@endsection
{{-- </x-app-layout> --}}
