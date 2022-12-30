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
            <li class="breadcrumb-item active" aria-current="page">Modificar Orden</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->

      <div class="card">
        <form class="" action="{{route('orders.update',$orders[0]->id)}}"  enctype="multipart/form-data" method="post">
          @method('PATCH')
          @csrf
        <div class="card-body p-4">
          <h5 class="card-title">Modificar Orden {{$orders[0]->nro_invoice}}</h5>
          <hr/>
                     <div class="form-body mt-4">
            <div class="row">
             <div class="col-lg-6">
             <div class="border border-3 p-4 rounded">
                    <div class="mb-3">
                        <label for="inputPrice" class="form-label">Nº de Factura</label>
                        <input type="text" name="nro_invoice" class="form-control" id="inputPrice" placeholder="" value="{{$orders[0]->nro_invoice}}">
                   </div>
                   <div class="mb-3">
                   <label for="inputProductType" class="form-label">Cliente</label>
                   <select class="form-select" name="client" id="inputProductType">
                        <option value="{{$orders[0]->client_id}}">{{$orders[0]->name}}</option>
                        @forelse($clients as $clientsItem)
                        <option value="{{$clientsItem->id}}">{{$clientsItem->name}}</option>
                        @empty
                        @endforelse
                     </select>
                   </div>
                   <div class="mb-3">
                        <a href="{{url('/')}}/assets/orders/{{$orders[0]->file_invoice}}" target="_blank"><i class="lni lni-empty-file"></i> Ver Factura </a>
                  </div>
                  <!-- <div class="mb-3">
                    <label for="inputProductDescription" class="form-label">Adjuntar Factura</label>
                    <input id="image-uploadify" type="file" name="file">
                  </div> -->
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary px-5">Actualizar</button>
                  </div>
              </div>
             </div>
           </div><!--end row-->
        </div>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection
