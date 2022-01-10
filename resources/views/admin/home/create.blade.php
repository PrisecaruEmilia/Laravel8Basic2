@extends('admin.admin_master')
@section('admin')
<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create About</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('store.about') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">About Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                    <label for="short_description">Short Description</label>
                    <textarea class="form-control" name="short_description" id="short_description" rows="3"></textarea>
                    @error('short_description')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                    <label for="long_description">Long Description</label>
                    <textarea class="form-control" name="long_description" id="long_description" rows="3"></textarea>
                    @error('long_description')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
