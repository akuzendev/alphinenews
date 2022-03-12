@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-2"><a class="btn btn-primary" href="{{ route('adminaddcommentform') }}">Add Comment</a></div>
        <div class="col-sm-10  d-flex justify-content-center"><h1>Comments</h1></div>
    </div>
<br>
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center">

            <table class="table table-hover table-responsive">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">By User ID</th>
                    <th scope="col">On Article ID</th>
                    <th scope="col">Content</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ( $comments as $comment )
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->byuserid }}</td>
                        <td>{{ $comment->onarticleid }}</td>
                        <td>{{ $comment->content }}</td>
                        <td>{{ $comment->status }}</td>
                        <td>


                            <ul class="list-group">
                                <li class="list-group-item"> <a href="{{ route('admingetcomment',['cid' => $comment->id ])}}"><i class="bi bi-arrows-fullscreen text-primary m-3"></i></a></li>
                                <li class="list-group-item"><a href="{{ route('admineditcommentform',['cid' => $comment->id ]) }}"><i class="bi bi-pencil-square text-success m-3"></i></a></li>
                                <li class="list-group-item">
                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#m{{ $comment->id }}">
                                    <i class="bi bi-trash3 text-danger m-3"></i>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    @if($comment->status !== array_search(config('enum.contentstatus.1'),config('enum.contentstatus')))

                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#m2{{ $comment->id }}">
                                        <i class="bi bi-unlock-fill text-info m-3"></i> Approve comment
                                    </a>

                                    {{-- <a type="button" class="" data-bs-toggle="modal" data-bs-target="#m3{{ $comment->id }}">
                                        <i class="bi bi-lock-fill  text-info m-3"></i> Revoke comment
                                    </a> --}}

                                    <!-- Modal -->
                                       <div class="modal fade" id="m2{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Approve comment {{ $comment->id }}?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Once approved, the comment will be visible to the Public.
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form method="POST" action="{{ route('adminapprovecomment',['cid' => $comment->id]) }}">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-info">Approve comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                                                             {{-- <!-- Modal -->
                                       <div class="modal fade" id="m3{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Revoke comment {{ $comment->id }}?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Once Revoked, the comment will be taken off from the Public view.
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form method="POST" action="{{ route('adminrevokecomment',['cid' => $comment->id]) }}">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-warning">Revoke comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div> --}}

                                    @else

                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#m3{{ $comment->id }}">
                                        <i class="bi bi-lock-fill  text-info m-3"></i> Revoke comment
                                    </a>

                                    <div class="modal fade" id="m3{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Revoke comment {{ $comment->id }}?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Once Revoked, the comment will be taken off from the Public view.
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form method="POST" action="{{ route('adminrevokecomment',['cid' => $comment->id]) }}">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-warning">Revoke comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>


                                    @endif
                                </li>
                            </ul>

                            {{-- @if($comment->authorizedbyid == null && $comment->authorizeddate == null)

                            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#m2{{ $comment->id }}">
                                <i class="bi bi-unlock-fill text-info m-3"></i> Approve comment
                            </a>

                            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#m3{{ $comment->id }}">
                                <i class="bi bi-lock-fill  text-info m-3"></i> Revoke comment
                            </a>

                            <!-- Modal -->
                               <div class="modal fade" id="m2{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Approve comment {{ $comment->id }}?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Once approved, the comment will be visible to the Public.
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form method="POST" action="{{ route('admindeletecomment',['cid' => $comment->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-info">Approve comment</button>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>

                                                                     <!-- Modal -->
                               <div class="modal fade" id="m3{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Revoke comment {{ $comment->id }}?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Once Revoked, the comment will be taken off from the Public view.
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form method="POST" action="{{ route('admindeletecomment',['cid' => $comment->id]) }}">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-warning">Revoke comment</button>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>

                            @else

                            @endif --}}



                               <!-- Modal -->
                               <div class="modal fade" id="m{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete comment {{ $comment->id }}?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Once deleted, data will be lost.
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form method="POST" action="{{ route('admindeletecomment',['cid' => $comment->id]) }}">
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
                        <td> No Comments Found...</td>
                    </tr>
                    @endforelse

                </tbody>
              </table>



        </div>
    </div>

</div>
@endsection
