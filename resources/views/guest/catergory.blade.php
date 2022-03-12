@extends('guest.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center"><h2>Showing Catergory for: {{ $ac }}</h2></div>
    </div>
<br>
<br>
    <div class="row">
        <div class="col-sm-12">
            <div class="row row-cols-1 row-cols-md-3 g-4">

                @if ($articlebycat)

                @foreach($articlebycat as $key => $value)
                    <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('thumbnail/' . $value->thumbnail) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">{{ $value->title }}</h5>
                        <p class="card-text">{{ $value->subtitle }}</p>
                        <br>
                        <p class="card-text">{{ $value->date }}</p>
                        <a href="{{ route('guestshowarticle',['id'=>$value->id]) }}" class="btn btn-primary">Read More...</a>
                        </div>
                    </div>
                </div>

                @endforeach
                @else
                <p class="card-text">No Articles Found...</p>
                @endif






              </div>

        </div>
    </div>
</div>

@endsection
