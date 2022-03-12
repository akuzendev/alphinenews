@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-2"><a class="btn btn-primary" href="{{ route('adminarticles') }}">Back</a></div>
        <div class="col-sm-10  d-flex justify-content-center"><h1>View Article of ID: {{ $article[0]['id'] }} </h1></div>
    </div>
    <div class="row">
        <div class="col-sm-9  d-flex justify-content-start"><h3>General Information:</h3></div>
        <div class="col-sm-3  d-flex justify-content-end">
            <a class="btn btn-success m-1" href="{{ route('admineditarticleform',['aid'=>$article[0]['id']]) }}"><i class="bi bi-pencil-square"></i></a>
            <a type="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#m{{ $article[0]['id'] }}">
                <i class="bi bi-trash3"></i>
            </a>


               <!-- Modal -->
               <div class="modal fade" id="m{{ $article[0]['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Article {{ $article[0]['id'] }}?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Once deleted, data will be lost.
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form method="POST" action="{{ route('admindeletearticle',['aid'=>$article[0]['id']]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete User</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>


        </div>
    </div>
<br>
            <table class="table table-hover table-responsive">
                <thead>
                <tr>
                    <th scope="col">meta</th>
                    <th scope="col">description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">ID</th>
                    <td>{{ $article[0]['id'] }}</td>
                </tr>
                <tr>
                    <th scope="row">Title</th>
                    <td>{{ $article[0]['title'] }}</td>
                </tr>
                <tr>
                    <th scope="row">Subtitle</th>
                    <td>{{ $article[0]['subtitle'] }}</td>
                </tr>
                <tr>
                    <th scope="row">Catergory</th>
                    <td>{{ $ac }}</td>
                </tr>
                <tr>
                    <th scope="row">Status</th>
                    <td>{{ $as }}</td>
                </tr>
                <tr>
                    <th scope="row">Thumbnail</th>
                    <td>{{ $article[0]['thumbnail'] }}</td>
                </tr>
                <tr>
                    <th scope="row">By User ID</th>
                    <td>{{ $article[0]['byuserid'] }}</td>
                    <td><a href="{{ route('admingetuser',['uid'=>$article[0]['byuserid']]) }}">Go to User details...</a></td>
                </tr>
                <tr>
                    <th scope="row">Content</th>
                    <td>{{ $article[0]['content'] }}</td>
                </tr>
                <tr>
                    <th scope="row">Date</th>
                    <td>{{ $article[0]['date'] }}</td>
                </tr>
                <tr>
                    <th scope="row">Authorized by ID</th>
                    @if($article[0]['authorizedbyid'] == null)
                        <td><span class="text-danger">The User who Authorized this article does not exist!</span></td>
                    @else
                        <td>{{ $article[0]['authorizedbyid'] }}</td>
                        <td><a href="{{ route('admingetuser',['uid'=>$article[0]['authorizedbyid']]) }}">Go to User details...</a></td>
                    @endif
                </tr>
                <tr>
                    <th scope="row">Authorized Date</th>
                    @if($article[0]['authorizeddate'] == null)
                        <td><span class="text-danger">The Article does not have an Authorization date!</span></td>
                    @else
                        <td>{{ $article[0]['authorizeddate'] }}</td>
                    @endif
                </tr>

                </tbody>
            </table>
<br>
<br>
<hr>
<br>
<br>

            </div>


</div>

@endsection
