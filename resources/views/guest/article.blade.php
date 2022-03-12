@extends('guest.layouts.app')

@section('content')
<main>

    <div class="px-4 py-5 my-5 text-center">
      <img class="d-block mx-auto px-3 py-4" src="{{ asset('thumbnail/' . $article[0]['thumbnail']) }}" alt="" width="672" height="357">
      <h1 class="display-5 fw-bold">{{ $article[0]['title'] }}</h1>
      <h3 class="display-7 fw-italic py-3">{{ $article[0]['subtitle'] }}</h3>
      <div class="d-grid gap-5 d-sm-flex justify-content-sm-center">
          <p class="px-2 gap-3">John Doe</p>
          <p class="px-2">{{ $article[0]['date'] }}</p>
      </div>
      <div class="col-lg-12 py-5 mx-auto">
        <p class="lead mb-4">{{ $article[0]['content'] }}</p>

      </div>
    </div>

    <div class="b-example-divider mb-0"></div>

    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">Comments</h1>
    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="px-5 py-1 my-5 text-start">


@forelse ($comments as $key => $value )
<br>

<div class="card py-4 px-4">
    <div class="comment-widgets m-b-20">
        <div class="d-flex flex-row comment-row">
            <div class="comment-text w-100">
                <h5 class="mx-4 my-4">{{ $commentauthor[0]['name'] }}</h5>
                <div class="comment-footer mx-4"> <span class="date">{{ $value['date'] }}</span></div>
                <br>
                <p class="m-b-5 m-t-10 mx-5">{{ $value['content'] }}</p>
            </div>
        </div>
    </div>
</div>
<br>
@empty
    <p class="d-flex justify-content-center">No Comments...</p>
@endforelse



              </div>
        </div>
    </div>
  </main>


@endsection
