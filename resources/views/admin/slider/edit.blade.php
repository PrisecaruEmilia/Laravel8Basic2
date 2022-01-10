@extends('admin.admin_master')
@section('admin')
<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Edit Slider</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('update.slider', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="old_image" value="{{ $slider->image }}" />
                <div class="form-group">
                    <label for="title">Slider Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" value="{{ $slider->title }}">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Slider Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3">{{ $slider->description }}</textarea>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Slider Image</label>
                    <input type="file" name="image" class="form-control-file" id="image">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}" style="height:200px; width:200px;">
                 </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
