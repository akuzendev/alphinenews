@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-2"><a class="btn btn-primary" href="{{ route('adminaddarticleform') }}">Add Articles</a></div>
        <div class="col-sm-10  d-flex justify-content-center"><h1>Articles</h1></div>
    </div>
<br>
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center">

            <table class="table table-hover table-responsive">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Subtitle</th>
                    <th scope="col">Catergory</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ( $articles as $article )
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->subtitle }}</td>
                        <td>{{ $article->catergory }}</td>
                        <td>{{ $article->status }}</td>
                        <td>


                            <ul class="list-group">
                                <li class="list-group-item"> <a href="{{ route('admingetarticle',['aid' => $article->id ])}}"><i class="bi bi-arrows-fullscreen text-primary m-3"></i></a></li>
                                <li class="list-group-item"><a href="{{ route('admineditarticleform',['aid' => $article->id ]) }}"><i class="bi bi-pencil-square text-success m-3"></i></a></li>
                                <li class="list-group-item">
                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#m{{ $article->id }}">
                                    <i class="bi bi-trash3 text-danger m-3"></i>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    @if($article->authorizedbyid === null && $article->authorizeddate === null)

                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#m2{{ $article->id }}">
                                        <i class="bi bi-unlock-fill text-info m-3"></i> Approve Article
                                    </a>

                                    {{-- <a type="button" class="" data-bs-toggle="modal" data-bs-target="#m3{{ $article->id }}">
                                        <i class="bi bi-lock-fill  text-info m-3"></i> Revoke Article
                                    </a> --}}

                                    <!-- Modal -->
                                       <div class="modal fade" id="m2{{ $article->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Approve Article {{ $article->id }}?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Once approved, the Article will be visible to the Public.
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form method="POST" action="{{ route('adminapprovearticle',['aid' => $article->id]) }}">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-info">Approve Article</button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                                                             {{-- <!-- Modal -->
                                       <div class="modal fade" id="m3{{ $article->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Revoke Article {{ $article->id }}?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Once Revoked, the Article will be taken off from the Public view.
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form method="POST" action="{{ route('adminrevokearticle',['aid' => $article->id]) }}">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-warning">Revoke Article</button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div> --}}

                                    @else

                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#m3{{ $article->id }}">
                                        <i class="bi bi-lock-fill  text-info m-3"></i> Revoke Article
                                    </a>

                                    <div class="modal fade" id="m3{{ $article->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Revoke Article {{ $article->id }}?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Once Revoked, the Article will be taken off from the Public view.
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form method="POST" action="{{ route('adminrevokearticle',['aid' => $article->id]) }}">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-warning">Revoke Article</button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>


                                    @endif
                                </li>
                            </ul>

                            {{-- @if($article->authorizedbyid == null && $article->authorizeddate == null)

                            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#m2{{ $article->id }}">
                                <i class="bi bi-unlock-fill text-info m-3"></i> Approve Article
                            </a>

                            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#m3{{ $article->id }}">
                                <i class="bi bi-lock-fill  text-info m-3"></i> Revoke Article
                            </a>

                            <!-- Modal -->
                               <div class="modal fade" id="m2{{ $article->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Approve Article {{ $article->id }}?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Once approved, the Article will be visible to the Public.
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form method="POST" action="{{ route('admindeletearticle',['aid' => $article->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-info">Approve Article</button>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>

                                                                     <!-- Modal -->
                               <div class="modal fade" id="m3{{ $article->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Revoke Article {{ $article->id }}?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Once Revoked, the Article will be taken off from the Public view.
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form method="POST" action="{{ route('admindeletearticle',['aid' => $article->id]) }}">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-warning">Revoke Article</button>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>

                            @else

                            @endif --}}



                               <!-- Modal -->
                               <div class="modal fade" id="m{{ $article->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Article {{ $article->id }}?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Once deleted, data will be lost.
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form method="POST" action="{{ route('admindeletearticle',['aid' => $article->id]) }}">
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
                        <td> No Articles Found...</td>
                    </tr>
                    @endforelse

                </tbody>
              </table>



        </div>
    </div>

</div>
@endsection
