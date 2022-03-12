@extends('admin.layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-2"><a class="btn btn-primary" href="{{ route('adminusers') }}">BACK</a></div>
        <div class="col-sm-10  d-flex justify-content-center"><h1>Add Article</h1></div>
    </div>
<br>
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center">


            <form class="row g-3 needs-validation" action="{{ route('adminadduser') }}" method="POST" novalidate>
                @csrf
                <div class="col-md-4">
                  <label for="validationCustom01" class="form-label">Name</label>
                  <input type="text" class="form-control" id="validationCustom02" name="name" required>
                  <div class="valid-feedback">
                    Ok!
                  </div>
                  <div class="invalid-feedback">
                    A Name is required!
                  </div>
                </div>





                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Status</label>
                    <select class="form-select" id="validationCustom04" name="status" required>
                          <option selected  disabled value="">Please Choose From Below...</option>
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

                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Role</label>
                    <select class="form-select" id="validationCustom04" name="role" required>
                          <option selected disabled value="">Please choose from below...</option>
                      @forelse ($designation as $key => $value )
                          <option value="{{ $key }}">{{ $value }}</option>
                      @empty
                          <option disabled>No Designation found...</option>
                      @endforelse
                    </select>
                    <div class="valid-feedback">
                      Ok.
                    </div>
                    <div class="invalid-feedback">
                      Please select a Designation.
                    </div>
                </div>



                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Email</label>
                    <input type="email" class="form-control" id="validationCustom02" name="email" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      An Email is Required!
                    </div>
                </div>



                <div class="col-md-12">
                    <label for="validationCustom02" class="form-label">Password</label>
                    <input type="password" class="form-control" id="validationCustom02" name="password" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      A Password is Required!
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
                  <button class="btn btn-primary" type="submit">Add User</button>
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
