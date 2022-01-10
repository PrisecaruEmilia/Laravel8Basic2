@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
       <div class="container-fluid">
           <div class="row">
               <div class="col-sm-12 col-md-6">
                   <h2>Contact Page</h2>
               </div>
               <div class="col-sm-12 col-md-6 d-md-flex flex-row-reverse">
                   <a href="{{ route('add.contact') }}"><button class="btn btn-success">Add Contact</button></a>
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
                           All Contact Data
                       </div>
                       <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" width="5%">SL No</th>
                                    <th scope="col" width="10%">Address</th>
                                    <th scope="col" width="10%">Email</th>
                                    <th scope="col" width="15%">Phone</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            <th scope="row"># {{ $i++ }}</th>
                                            <td>{{ $contact->address }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>
                                                <a href="{{ url('contact/edit/'.$contact->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ url('contact/delete/'.$contact->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
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
