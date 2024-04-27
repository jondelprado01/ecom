<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-center">
                        <strong>User Table</strong>
                    </div>
                    <div class="card-body text-center">
                        <table class="table table-striped user-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->roles->role}}</td>
                                        <td>
                                            @if(Auth::user()->id != $user->id && Auth::user()->role == 1)
                                                @if($user->role != 1)
                                                    <button request-type="user" id="{{$user->id}}" type="button" class="btn btn-primary btn-toadmin-user" data-target="{{ucfirst($user->name)}}">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                        Make an Admin
                                                    </button>
                                                @endif
                                                <button request-type="user" id="{{$user->id}}" type="button" class="btn btn-danger btn-delete-user" data-target="{{ucfirst($user->name)}}">
                                                    <i class="fa-solid fa-trash"></i>
                                                    Delete
                                                </button>
                                            @endif
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

</x-app-layout>
