@extends('guest.layouts.app')

@section('content')

<br>
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
        <div class="container-fluid">
          <a class="navbar-brand px-5"><h2>Recent Articles</h2></a>
        </div>
    </nav>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <div class="col">
              <div class="card">
                <img src="https://picsum.photos/536/354" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
              </div>
            </div>

            <div class="col">
                <div class="card">
                  <img src="https://picsum.photos/536/354" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="card">
                  <img src="https://picsum.photos/536/354" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  </div>
                </div>
              </div>


          </div>
        {{--
        <div class="col-sm-12 d-flex justify-content-center">

            <div class="card mb-1" style="max-width: 750px;">
                <div class="row g-0">
                  <div class="col-md-7">
                    <img src="https://picsum.photos/536/354" class="img-fluid rounded-start" height="300px" width="400px" alt="...">
                  </div>
                  <div class="col-md-5">
                    <div class="card-body">
                        <span class="badge rounded-pill bg-danger">Breaking News</span>
                      <p class="card-title"><h4>Card title<h4></p>
                      <p class="card-text"><h6>This is a wider card with supporting.</h6></p>
                      <div class="row my-4">
                          <div class="col-5"><p class="card-text"><small class="text-muted">John doe</small></p></div>
                          <div class="col-7"><p class="card-text"><small class="text-muted">12/04/2022 11:31</small></p></div>
                      </div>
                      <a class="btn btn-primary my-3" href="">Read More...</a>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        --}}
    </div>
</div>
<br>
<br>
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
        <div class="container-fluid">
          <a class="navbar-brand px-5"><h2>Local</h2></a>
        </div>
    </nav>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="row row-cols-1 row-cols-md-3 g-4">

                <div class="col">
                  <div class="card">
                    <img src="https://picsum.photos/536/354" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                  </div>
                </div>


              </div>

        </div>
    </div>
</div>
<br>
<br>
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
        <div class="container-fluid">
          <a class="navbar-brand px-5"><h2>World</h2></a>
        </div>
    </nav>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-12">




        </div>
    </div>
</div>
@endsection
