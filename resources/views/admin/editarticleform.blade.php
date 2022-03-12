@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-2"><a class="btn btn-primary" href="{{ route('adminarticles') }}">Back</a></div>
        <div class="col-sm-10  d-flex justify-content-center"><h1>Edit Article </h1></div>
    </div>
<br>
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center">


            <form class="row g-3 needs-validation" enctype="multipart/form-data" action="{{ route('admineditarticle',['aid'=>$article[0]['id']]) }}" method="POST" novalidate>
                @csrf
                @method('PUT');
                <div class="col-md-4">
                  <label for="validationCustom01" class="form-label">Title</label>
                  <input type="text" class="form-control" id="validationCustom02" name="title" value="{{ $article[0]['title'] }}" required>
                  <div class="valid-feedback">
                    Ok!
                  </div>
                  <div class="invalid-feedback">
                    A Title is required!
                  </div>
                </div>

                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">Subtitle</label>
                  <input type="text" class="form-control" id="validationCustom02" name="subtitle" value="{{ $article[0]['subtitle'] }}" required>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    A Subtitle is Required!
                  </div>
                </div>

                <div class="col-md-4">
                    <label for="validationCustom02" class="form-label">Date</label>
                    <input type="datetime-local" class="form-control" id="validationCustom02" name="date" value="{{ date('Y-m-d\TH:i', strtotime($article[0]['date'])) }}" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      A Date is Required!
                    </div>
                  </div>


                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Catergory</label>
                    <select class="form-select" id="validationCustom04" name="catergory" required>
                      <option selected value="{{ $article[0]['catergory']}}">{{ $ad }}</option>
                          <option disabled>___________</option>
                      @forelse ($catergory as $key => $value )
                          <option value="{{ $key }}">{{ $value }}</option>
                      @empty
                          <option disabled>No catergory found...</option>
                      @endforelse
                    </select>
                    <div class="valid-feedback">
                      Ok.
                    </div>
                    <div class="invalid-feedback">
                      Please select a catergory.
                    </div>
                </div>


                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Status</label>
                    <select class="form-select" id="validationCustom04" name="status" required>
                      <option selected value="{{ $article[0]['status'] }}">{{ $as }}</option>
                          <option disabled>___________</option>
                      @forelse ($status as $key => $value )
                          <option value="{{ $key }}">{{ $value }}</option>
                      @empty
                          <option disabled>No status found...</option>
                      @endforelse
                    </select>
                    <div class="valid-feedback">
                      Ok.
                    </div>
                    <div class="invalid-feedback">
                      Please select a Status.
                    </div>
                </div>


                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Thumbnail</label>
                    <input type="file" class="form-control" id="validationCustom02" name="thumbnail" value="{{ $article[0]['thumbnail'] }}">
                    <span>Current Thumbnail: {{ $article[0]['thumbnail'] }}</span>
                    {{-- <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      A Thumbnail of .jpg, .jpeg, .png file is Required!
                    </div> --}}
                </div>


                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">By User ID:</label>
                    <select class="form-select" id="validationCustom04" name="byuserid" required>
                        <option selected value="{{ $currentauthor[0]['id'] }}">{{ $currentauthor[0]['name'] }}</option>
                        <option disabled>___________</option>
                    @forelse ($approvedauthors as $key => $value )
                        <option value="{{ $value }}">{{ $key }}</option>
                    @empty
                        <option disabled>No Users found...</option>
                    @endforelse
                    </select>
                    <div class="invalid-feedback">
                      Please select a User.
                    </div>
                  </div>



                <div class="col-md-12">
                    <label for="validationCustom02" class="form-label">Content</label>
                    <input type="text" class="form-control" id="validationCustom02" name="content" value="{{ $article[0]['content'] }}" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      Article Content is Required!
                    </div>
                </div>



                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                      Agree to terms and conditions
                    </label>
                    <div class="invalid-feedback">
                      You must agree before submitting.
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary" type="submit">Add Article</button>
                </div>
              </form>


        </div>
    </div>
</div>



<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>


@endsection
