@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->



<div class="wrapper">
  <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
    <div class="container">
      <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
        <div class="col mx-auto">
          <div class="my-4 text-center">
            <img src="{{url('/')}}/assets/images/logodelyar.png"  class="logo-icon" alt="logo icon" width="180px">
          </div>
          <div class="card">
            <div class="card-body">
              <div class="border p-4 rounded">
                <div class="text-center">
                  <h3 class="">Registro</h3>
                  <p>¿Ya tienes una cuenta? <a href="{{route('login')}}">Ingresa Aqui</a>
                  </p>
                </div>
                <div class="login-separater text-center mb-4"> <span>FORMUALRIO DE REGISTRO</span>
                  <hr/>
                </div>
                <div class="form-body">
                  <form class="row g-3" method="POST" action="{{ route('register') }}">
                      @csrf
                    <div class="col-sm-6">
                      <label for="inputFirstName" class="form-label">Nombre</label>
                      <input type="text" name="name" class="form-control" id="inputFirstName" placeholder="Jorge Carlos">
                    </div>
                    <div class="col-sm-6">
                      <label for="inputLastName" class="form-label">Apeliido</label>
                      <input type="text" name="lastname" class="form-control" id="inputLastName" placeholder="Rodriguez">
                    </div>
                    <div class="col-12">
                      <label for="email" class="form-label">Direccion de Email</label>
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="col-12">
                      <label for="inputChoosePassword" class="form-label">Password</label>
                      <div class="input-group" id="show_hide_password">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="password-confirm" class="form-label">Confirmar Password</label>
                      <div class="input-group" id="show_hide_password">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                      </div>
                    </div>




                    <div class="col-12">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Acepto los terminos y condiciones</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="d-grid">
                        <button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Registrarme</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--end row-->
    </div>
  </div>
</div>




@endsection
