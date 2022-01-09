{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-flex justify-content-between">
            <b>Edit Brand</b>
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
                        <div class="card-header">
                            Edit brand
                        </div>
                        <div class="card-body">
                            <form action="{{ url('brand/update/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{ $brand->brand_image }}" />
                                <div class="form-group">
                                  <label for="brand_name">Brand Name</label>
                                  <input type="text" name="brand_name" class="form-control" id="brand_name" aria-describedby="emailHelp" value="{{ $brand->brand_name }}">
                                  @error('brand_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                  @enderror
                                </div>
                                <div class="form-group">
                                    <label for="brand_image">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="brand_image" aria-describedby="emailHelp" value="{{ $brand->brand_image }}">
                                    @error('brand_image')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                   <img src="{{ asset($brand->brand_image) }}" alt="{{ $brand->brand_name }}" style="height:200px; width:200px;">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
@endsection
{{-- </x-app-layout> --}}
