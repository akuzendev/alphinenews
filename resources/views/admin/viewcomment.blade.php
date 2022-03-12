@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-2"><a class="btn btn-primary" href="{{ route('admincomments') }}">Back</a></div>
        <div class="col-sm-10  d-flex justify-content-center"><h1>View Comment of ID: {{ $comment[0]['id'] }}</h1></div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-9  d-flex justify-content-start"><h3>General Information:</h3></div>
        <div class="col-sm-3  d-flex justify-content-end">
            <a class="btn btn-success m-1" href="{{ route('admineditcommentform',['cid'=>$comment[0]['id']]) }}"><i class="bi bi-pencil-square"></i></a>
            <a type="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#m{{ $comment[0]['id'] }}">
                <i class="bi bi-trash3"></i>
            </a>


               <!-- Modal -->
               <div class="modal fade" id="m{{ $comment[0]['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete comment {{ $comment[0]['id'] }}?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Once deleted, data will be lost.
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form method="POST" action="{{ route('admindeletecomment',['cid'=>$comment[0]['id']]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete comment</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>


        </div>
    </div>
<br>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">meta</th>
                        <th scope="col">description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">ID</th>
                        <td>{{ $comment[0]['id'] }}</td>
                    </tr>
                    <tr>
                        <th scope="row">By User ID</th>
                        @if($comment[0]['byuserid'] == null)
                            <td><span class="text-danger">The User does not exist!</span></td>
                        @else
                            <td>{{ $comment[0]['byuserid'] }}</td>
                            <td><a href="{{ route('admingetuser',['uid'=>$comment[0]['byuserid']]) }}">Go to User details...</a></td>
                        @endif
                    </tr>
                    <tr>
                        <th scope="row">Status</th>
                        <td colspan="2">{!! $status !!}</td>
                    </tr>
                    <tr>
                        <th scope="row">On Article ID</th>
                        @if($comment[0]['onarticleid'] == null)
                            <td><span class="text-danger">The Article does not exist!</span></td>
                        @else
                            <td>{{ $comment[0]['onarticleid'] }}</td>
                            <td><a href="{{ route('admingetarticle',['aid'=>$comment[0]['onarticleid']]) }}">Go to Article details...</a></td>
                        @endif
                    </tr>
                    <tr>
                        <th scope="row">Content</th>
                        <td colspan="2">{{ $comment[0]['content'] }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Date</th>
                        <td colspan="2">{{ $comment[0]['date'] }}</td>
                    </tr>
                    </tbody>
                </table>
<br>
<br>
<hr>
<br>
<br>
            <div class="row">
                <div class="col-sm-12  d-flex justify-content-start"><h3>Reports against This Comment</h3></div>
            </div>

            </div>


</div>

@endsection
