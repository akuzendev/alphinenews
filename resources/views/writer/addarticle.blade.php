@extends('writer.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-2"><a class="btn btn-primary" href="{{ route('adminarticles') }}">Back</a></div>
        <div class="col-sm-10  d-flex justify-content-center"><h1>Add Article</h1></div>
    </div>
<br>
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center">


            <form class="row g-3 needs-validation" enctype="multipart/form-data" action="{{ route('writeraddyourarticle') }}" method="POST" novalidate>
                @csrf
                <div class="col-md-4">
                  <label for="validationCustom01" class="form-label">Title</label>
                  <input type="text" class="form-control" id="validationCustom02" name="title" required>
                  <div class="valid-feedback">
                    Ok!
                  </div>
                  <div class="invalid-feedback">
                    A Title is required!
                  </div>
                </div>

                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">Subtitle</label>
                  <input type="text" class="form-control" id="validationCustom02" name="subtitle" required>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    A Subtitle is Required!
                  </div>
                </div>


                <div class="col-md-4">
                    <label for="validationCustom02" class="form-label">Date</label>
                    <input type="datetime-local" class="form-control" id="validationCustom02" name="date" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      A Date is Required!
                    </div>
                  </div>


                <div class="col-md-6">
                  <label for="validationCustom04" class="form-label">Catergory</label>
                  <select class="form-select" id="validationCustom04" name="catergory" required>
                        <option selected disabled value="">Please Choose from Below:...</option>
                    @forelse ($catergories as $key => $value )
                        <option value="{{ $key }}">{{ $value }}</option>
                    @empty
                        <option disabled>No Catergories found...</option>
                    @endforelse
                  </select>
                  <div class="valid-feedback">
                    Ok.
                  </div>
                  <div class="invalid-feedback">
                    Please select a Catergories.
                  </div>
                </div>



                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Thumbnail</label>
                    <input type="file" class="form-control" id="validationCustom02" name="thumbnail" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      A Thumbnail of .jpg, .jpeg, .png file is Required!
                    </div>
                </div>





                <div class="col-md-12">
                    <label for="validationCustom02" class="form-label">Content</label>
                    <input type="text" class="form-control" id="validationCustom02" name="content" required>
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

