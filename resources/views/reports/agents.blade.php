@extends('layouts.app')
@section('css')
<style media="screen">
@media print {
  .sidebar-wrapper.no-print, .imprimir, .btn-primary, .btn {
    display: none !important;
}
.page-wrapper {
    margin-left: 0;
  }
}
</style>
@endsection
@section('content')
<div class="wrapper">
  <!--sidebar wrapper -->
@include('partials.sidebar')
  <div class="page-wrapper">
    <div class="page-content">
      <div class="card radius-10">
        <div class="card-body">
          <form class="" action="{{route('agents')}}" method="post">
            @csrf
            <div class="">
              <div class="row" >
                <div class="col-3">
                  <small>Desde</small>
                  <input type="date" class="form-control" name="date1" value="">
                </div>
                <div class="col-3">
                  <small>Hasta</small>
                  <input type="date" class="form-control" name="date2" value="">
                </div>
                <div class="col-3">
                  <small>Usuario</small>
                  <select class="form-select single-select" name="user" required>
                    <option selected value="0">Todos</option>
                    @forelse($users as $usersItem)
                    <option value="{{$usersItem->id}}">{{$usersItem->name}}</option>
                    @empty
                    @endforelse
                  </select>
                </div>
                <div class="col-3">
                    <small><br> </small>
                  <input type="submit" name="" value="ENVIAR" class="btn btn-primary">
                </div>
              </div>
              <div class="font-22 ms-auto">
              </div>
            </div>
          </form>
          <hr/>
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>Fecha</th>
                  <th>Localizador</th>
                  <th>neto</th>
                  <th>PVP</th>
                  <th>Total</th>
                  <th>Usuario</th>
                  <!-- <th class="text-center" >Check</th> -->
                </tr>
              </thead>
              <tbody>
                @forelse($daily as $dailyItems)
                <tr>
                  <td>{{$dailyItems->created_at}}</td>
                  <td>{{$dailyItems->localizador}}</td>
                  <td>{{$dailyItems->neto}}€</td>
                  <td>{{$dailyItems->pvp}}€</td>
                  <td>{{round($dailyItems->pvp - $dailyItems->neto,2)}}€</td>
                  <td>{{$dailyItems->name}}</td>
                </tr>

                @empty
                @endforelse
              </tbody>
              <tfoot  class="table-light">
                <td><b>Cantidad de servicios:{{$cantservicios[0]->servicios}}</b> </td>
                <td></td>
                <td></td>
                <td><b>{{$totales[0]->totalneto}}€</b> </td>
                <td><b>{{$totales[0]->totalpvp}}€</b> </td>
                <td><b>{{$totales[0]->totalpvp - $totales[0]->totalneto}}€</b> </td>
                <td></td>
              </tfoot>
            </table>
            <div class="text-end mt-4">
              <button type="button" name="button" class="imprimir btn btn-primary " onclick="window.print();return false;">IMPRIMIR</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--end page wrapper -->
  <!--start overlay-->
  <div class="overlay toggle-icon"></div>
  <!--end overlay-->
  <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
  <!--End Back To Top Button-->
</div>
@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection
