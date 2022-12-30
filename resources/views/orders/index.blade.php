@extends('layouts.app')
@section('css')
<style media="screen">
input.points {
  width: 110px;
}
</style>
@endsection
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
            <li class="breadcrumb-item active" aria-current="page">Ordendes</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <a href="{{route('orders.create')}}"  class="btn btn-primary px-5 radius-30">Nueva orden</a>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">ORDENES</h6>
    <hr/>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Nº de Factura</th>
                <th>Fecha de carga</th>
                <th>Cliente</th>
                <th>Factura</th>
                <th>Monto</th>
                <th>Puntos</th>
                <th>Editar</th>
                <th>Borrar</th>
              </tr>
            </thead>
            <tbody>
              @forelse($orders as $ordersItem)
              <tr>
                <td>{{$ordersItem->nro_invoice}}</td>
                <td>{{ date("d-m-Y", strtotime($ordersItem->created_at)) }}</td>
                <td>{{$ordersItem->name}}</td>
                <td><a href="{{url('/')}}/assets/orders/{{$ordersItem->file_invoice}}" target="_blank"><i class="lni lni-empty-file"></i> </a></td>
                <td>{{$ordersItem->amount_invoice}}</td>
                <td>
                  <!-- validation if  has points or not, so, show the points or the form -->
                  @if($ordersItem->points)
                  {{$ordersItem->points}}
                  @else
                  <div class="">
                    <form class="" action="{{route('points.store')}}" method="post">
                      @csrf
                      <input type="number" name="points" value="" class="points">
                      <input type="button" name="" value="x2">
                      <input type="button" name="" value="x3">
                      <input type="submit" name="" value="OK">
                      <input type="hidden" name="client" value="{{$ordersItem->client}}">
                      <input type="hidden" name="nro_invoice" value="{{$ordersItem->nro_invoice}}">
                      <input type="hidden" name="order_id" value="{{$ordersItem->id}}">
                    </form>
                  </div>
                  @endif
                </td>
                <th><a href="{{route('orders.edit',$ordersItem->id)}}"><i class="lni lni-pencil-alt"></i></a> </th>
                <th><a href="{{route('orders.destroy',$ordersItem->id)}}"><i class="lni lni-trash"></i></a> </th>
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
