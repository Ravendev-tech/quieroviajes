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
            <li class="breadcrumb-item active" aria-current="page">Editar Destino</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->

      <div class="col-lg-6">
        <div class="card">
          <form class="" action="{{route('destination.update',$destination[0]->id_destination)}}"  enctype="multipart/form-data" method="post">
            @method('PATCH')
            @csrf
          <div class="card-body p-4">
            <h5 class="card-title">Editar Destino</h5>
            <hr/>
                       <div class="form-body mt-4">
              <div class="row">
               <div class="col-lg-8">
                           <div class=" p-4 rounded">
              <div class="mb-3">
                <label for="inputProductTitle" class="form-label">Nombre</label>
                <input type="text" name="name_destination" class="form-control" id="name_destination" value="{{$destination[0]->name_destination}}" placeholder="Nombre del Destino">
                </div>
                <div class="mb-3">
                  <button type="submit" class="btn btn-primary">Guardar </button>
                </div>
                            </div>
               </div>
               <div class="col-lg-4">
              </div>
             </div><!--end row-->
          </div>
          </div>
        </form>
      </div>
      </div>

  </div>
</div>
@endsection
