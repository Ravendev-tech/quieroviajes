@extends('layouts.app')
@section('content')
<div class="wrapper">
  <!--sidebar wrapper -->
@include('partials.sidebar')
<div class="page-wrapper">
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Inicio</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <a href="{{route('clients.create')}}"  class="btn btn-primary px-5 radius-30">Nuevo Usuarios</a>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Lista de Usuarios</h6>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <hr/>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Whatsapp</th>
                <th>Email</th>
                <th>Editar</th>
                <th>Borrar</th>
              </tr>
            </thead>
            <tbody>
              @forelse($clients as $clientsItem)
              <tr>
                <td>{{$clientsItem->name}}</td>
                <td>{{$clientsItem->phone}}</td>
                <td>{{$clientsItem->whatsapp}}</td>
                <td>{{$clientsItem->email}}</td>
                <th><a href="{{route('clients.edit',$clientsItem->id)}}"><i class="lni lni-pencil-alt"></i></a> </th>
                <th><a href="{{route('clients.destroy',$clientsItem->id)}}"><i class="lni lni-trash"></i></a> </th>
              </tr>
              @empty
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
