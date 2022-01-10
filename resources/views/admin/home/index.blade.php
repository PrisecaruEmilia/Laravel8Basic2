@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
       <div class="container-fluid">
           <div class="row">
               <div class="col-sm-12 col-md-6">
                   <h2>Home About</h2>
               </div>
               <div class="col-sm-12 col-md-6 d-md-flex flex-row-reverse">
                   <a href="{{ route('add.about') }}"><button class="btn btn-success">Add About</button></a>
               </div>
           </div>
           <div class="row mt-5">
               <div class="col-md-12">
                   <div class="card">
                       @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                       <div class="card-header">
                           All About Data
                       </div>
                       <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" width="5%">SL No</th>
                                    <th scope="col" width="10%">Title</th>
                                    <th scope="col" width="10%">Short Description</th>
                                    <th scope="col" width="15%">Long Description</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                    @foreach ($about as $ab)
                                        <tr>
                                            <th scope="row"># {{ $i++ }}</th>
                                            <td>{{ $ab->title }}</td>
                                            <td>{{ $ab->short_description }}</td>
                                            <td>{{ $ab->long_description }}</td>
                                            <td>
                                                <a href="{{ url('about/edit/'.$ab->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ url('about/delete/'.$ab->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                       </div>

                    </div>
                </div>
            </div>
       </div>
    </div>
@endsection
