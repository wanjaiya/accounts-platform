@extends('layouts.app')

@section('content')

<section class="vh-100 bg-image" style="background-image: url('{{ asset('assets/images/background.jpg') }}');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              @if($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif

              <form action="{{ route('login') }}" method="POST">

                @csrf

                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="email">Your Email</label>
                  <input type="email" name="email" id="email" class="form-control form-control-lg" />

                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                     <label class="form-label" for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control form-control-lg" />

                </div>



                <div class="d-flex justify-content-center">
                  <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block btn-lg gradient-custom-4 ">Login</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Create an account? <a href="#!"
                    class="fw-bold text-body"><a href={{ route('register') }}><u>here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
