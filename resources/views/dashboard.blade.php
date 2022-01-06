<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-flex justify-content-between">
            <b> Hi {{ Auth::user()->name }} </b>
            <b>Total users: <span class="badge badge-danger">{{ count($users) }}</span></b>
        </h2>
    </x-slot>

    <div class="py-12">
       <div class="container">
           <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">User No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created At</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                      <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
           </div>
       </div>
    </div>
</x-app-layout>
