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
            <li class="breadcrumb-item active" aria-current="page">Expedientes</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <a href="{{route('travels.create')}}"  class="btn btn-primary px-5 radius-30">Nuevo Expediente</a>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Expedientes</h6>
    <hr/>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example2" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Localizador</th>
                <th>Persona</th>
                <th>Fecha de Salida</th>
                <th>Saldo</th>
                <th>Agente</th>
                <th>Editar</th>
                <th>pagos</th>
                <th>Borrar</th>
              </tr>
            </thead>
            <tbody>
              @forelse($expedientes as $expedientesItem)
              <tr>
                <td>{{$expedientesItem->id_travels}}</td>
                <td>{{$expedientesItem->localizador}}</td>
                <td>{{$expedientesItem->client_fullname}}</td>
                <td>{{$expedientesItem->date_departure}}</td>
                <td>
                  <?php
                  $checkpaid = App\Http\Controllers\PaymentController::checkpaid($expedientesItem->localizador);
                  $checktotal = App\Http\Controllers\PaymentController::checktotal($expedientesItem->localizador);
                  ?>
                  {{$checktotal - $checkpaid}}€
                </td>
                <td>{{$expedientesItem->name}}</td>
                <th><a href="{{route('travels.edit',$expedientesItem->localizador)}}"><i class="lni lni-pencil-alt"></i></a> </th>
                <th>
                  @if(is_null($expedientesItem->localizador_val))
                  <a href="{{route('payment.edit',$expedientesItem->localizador)}}"><i class="lni lni-money-location bnt-danger"></i></a>
                  @else
                  <a href="{{route('payment.edit',$expedientesItem->localizador)}}"><i class="lni lni-wallet"></i></a>
                  @endif
                </th>
                <th><a href="{{route('travels.destroy',$expedientesItem->localizador)}}"><i class="lni lni-trash"></i></a> </th>
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
@section('scripts')
<script type="text/javascript">

$(document).ready(function() {
$('#example2').DataTable({
  order: [[4, 'desc']],
  "pageLength": 50,
  "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
  }
});
} );
</script>
@endsection
