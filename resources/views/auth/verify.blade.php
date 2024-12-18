@extends('layouts.app')

@section('content')

<section class="vh-100 bg-image" style="background-image: url('{{ asset('assets/images/background.jpg') }}');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Account Verification</h2>
              @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif
              @if($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif

              <form action="{{ route('user.account_verification') }}" method="POST">

                @csrf
                <input type="hidden" name="user" value="{{ $id }}">
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="name">Enter Verification Code</label>
                  <input type="text" name="token" id="name" class="form-control form-control-lg" />

                </div>

                <div class="d-flex justify-content-center">
                  <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block btn-lg gradient-custom-4 ">Verify</button>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
