@extends('layouts.app')
@section('content')
<div class="wrapper">
  <!--sidebar wrapper -->
@include('partials.sidebar')
<div class="page-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-xl-7 mx-auto">
        <div class="card border-top border-0 border-4 border-primary">
          <div class="card-body p-5">
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="card-title d-flex align-items-center">
              <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
              </div>
              <h5 class="mb-0 text-primary">Registro de usuario</h5>
            </div>
            <hr>
            <form class="row g-3" action="{{route('clients.store')}}" method="post">
              @csrf
              <div class="col-md-6">
                <label for="inputFirstName" class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" id="inputFirstName">
              </div>
              <div class="col-md-6">
                <label for="inputLastName" class="form-label">Apellido</label>
                <input type="text" name="lastname" class="form-control" id="inputLastName">
              </div>
              <div class="col-md-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail">
              </div>
              <div class="col-md-6">
                <label for="inputPassword" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" id="inputPassword">
              </div>
              <div class="col-6">
                <label for="inputAddress" class="form-label">Dirección</label>
                <input type="text" name="address" class="form-control" id="inputLastName" placeholder="Direccion">
              </div>
              <div class="col-md-6">
                <label for="inputCity" class="form-label">Ciudad</label>
                <input type="text" name="city" class="form-control" id="inputCity">
              </div>
              <div class="col-6">
                <label for="" class="form-label">Telefono</label>
                <input type="text" name="phone" class="form-control" id="phone">
              </div>
              <div class="col-md-6">
                <label for="" class="form-label">Whatsapp</label>
                <input type="text" name="whatsapp" class="form-control" id="whatsapp">
              </div>
              <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary px-5">Registrar</button>
              </div>
            </form>
          </div>
        </div>
  </div>
</div>
</div>

@endsection
