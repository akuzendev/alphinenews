@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12  d-flex justify-content-center"><img src="{{ URL::to('/') }}/img/blocked.png"/></div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12  d-flex justify-content-center"><h2 class="text-danger">This User Has been Blocked</h2></div>
    </div>
<br>
<br>
<br>
<br>

    <div class="row align-items-center">
        <div class="col">
          <h3>Why did I get blocked?</h3>
          <p>Site Administrators have determined that your actions have warranted the restrictions of further use of the {{ config('app.name') }} app.</p>
        </div>
        <div class="col">
          <h3>How to get Unblocked?</h3>
          <p>Admin Decides this</p>
        </div>
      </div>




@endsection
