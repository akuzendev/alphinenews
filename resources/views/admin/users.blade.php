@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-2"><a class="btn btn-primary" href="{{ route('adminadduserform') }}">Add User</a></div>
        <div class="col-sm-10  d-flex justify-content-center"><h1>Users</h1></div>
    </div>
<br>
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center">

            <table class="table table-hover table-responsive">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ( $users as $user )
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->status }}</td>
                        <td>
                            <a href="{{ route('admingetuser',['uid' => $user->id ])}}"><i class="bi bi-arrows-fullscreen text-primary m-3"></i></a>
                            <a href="{{ route('adminedituserform',['uid' => $user->id ]) }}"><i class="bi bi-pencil-square text-success m-3"></i></a>
                            <!-- Button trigger modal -->
                            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#m{{ $user->id }}">
                                <i class="bi bi-trash3 text-danger m-3"></i>
                            </a>

                               <!-- Modal -->
                               <div class="modal fade" id="m{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete User {{ $user->id }}?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Once deleted, data will be lost.
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form method="POST" action="{{ route('admindeleteuser',['uid' => $user->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete User</button>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    @empty
                    <br>
                    <tr>
                        <td> No Users Found...</td>
                    </tr>
                    @endforelse

                </tbody>
              </table>



        </div>
    </div>

</div>

@endsection
