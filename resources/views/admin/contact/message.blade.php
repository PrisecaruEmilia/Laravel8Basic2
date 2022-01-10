@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
       <div class="container-fluid">
           <div class="row">
               <div class="col-sm-12 col-md-6">
                   <h2>Messages Page</h2>
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
                           All Messages
                       </div>
                       <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" width="5%">SL No</th>
                                    <th scope="col" width="10%">Name</th>
                                    <th scope="col" width="10%">Email</th>
                                    <th scope="col" width="15%">Subject</th>
                                    <th scope="col" width="15%">Message</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                    @foreach ($messages as $message)
                                        <tr>
                                            <th scope="row"># {{ $i++ }}</th>
                                            <td>{{ $message->name }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ $message->subject }}</td>
                                            <td>{{ $message->message }}</td>
                                            <td>
                                                <a href="{{ url('message/delete/'.$message->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
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
