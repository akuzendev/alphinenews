@extends('writer.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-2"><a class="btn btn-primary" href="{{ route('writeraddyourarticleform') }}">Add Articles</a></div>
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
                                <li class="list-group-item"> <a href="{{ route('writerviewyourarticle',['aid' => $article->id ])}}"><i class="bi bi-arrows-fullscreen text-primary m-3"></i></a></li>
                                <li class="list-group-item"><a href="{{ route('writeredityourarticleform',['aid' => $article->id ]) }}"><i class="bi bi-pencil-square text-success m-3"></i></a></li>
                                <li class="list-group-item">
                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#m{{ $article->id }}">
                                    <i class="bi bi-trash3 text-danger m-3"></i>
                                    </a>
                                </li>
                            </ul>

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
                                        <form method="POST" action="{{ route('writerdeleteyourarticle',['aid' => $article->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete Article</button>
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
