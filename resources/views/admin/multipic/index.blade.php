{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-flex justify-content-between">
            <b>Multi pictures</b>
            <b><span class="badge badge-danger"></span></b>
        </h2>
    </x-slot> --}}
@extends('admin.admin_master')
@section('admin')
    <div class="py-12">
       <div class="container">
           <div class="row">
               <div class="col-md-8">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card-group">
                        @foreach ($images as $image)
                            <div class="col-md-4 mt-5">
                                <div class="card">
                                    <img src="{{ asset($image->image) }}" alt="image">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Multi Image
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.images') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="image">Multi Image</label>
                                    <input type="file" name="image[]" class="form-control" id="image" aria-describedby="emailHelp" multiple="">
                                    @error('image')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                  </div>
                                <button type="submit" class="btn btn-primary">Add Image</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
@endsection
{{-- </x-app-layout> --}}
