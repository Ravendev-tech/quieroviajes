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
            <li class="breadcrumb-item active" aria-current="page">Destinos</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <a href="{{route('destination.create')}}"  class="btn btn-primary px-5 radius-30">Nuevo Destino</a>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">DESTINOS</h6>
    <hr/>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          @if(session()->has('success'))
              <div class="alert alert-success">
                  {{ session()->get('success') }}
              </div>
          @endif
          <table id="example" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Editar</th>
                <th>Borrar</th>
              </tr>
            </thead>
            <tbody>
              @forelse($destinations as $destinationsItem)
              <tr>
                <td>{{$destinationsItem->id_destination}}</td>
                <td>{{$destinationsItem->name_destination}}</td>
                <th><a href="{{route('destination.edit',$destinationsItem->id_destination)}}"><i class="lni lni-pencil-alt"></i></a> </th>
                <th><a href="#"data-bs-toggle="modal" data-bs-target="#deletemodal{{$destinationsItem->id_destination}}"><i class="lni lni-trash"></i></a> </th>
              </tr>
              <!-- modal -->
              <div class="modal fade" id="deletemodal{{$destinationsItem->id_destination}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Eliminar</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">¿Deseas Eliminar este Destino?</div>
                    <div class="modal-footer">
                      <form class="" action="{{route('destination.destroy',$destinationsItem->id_destination)}}" method="get">
                        @method('post')
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Eliminar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- endmodal -->
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
