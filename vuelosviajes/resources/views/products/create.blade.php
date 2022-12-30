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
            <li class="breadcrumb-item active" aria-current="page">Crear Producto</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->

      <div class="card">
      <form class="" action="{{route('product.store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="card-body p-4">
          <h5 class="card-title">Crear Nuevo Producto</h5>
          <hr/>
                     <div class="form-body mt-4">
            <div class="row">
             <div class="col-lg-8">
                         <div class="border border-3 p-4 rounded">
            <div class="mb-3">
              <label for="inputProductTitle" class="form-label">Titulo</label>
              <input type="text" name="title" class="form-control" id="inputProductTitle" placeholder="Nombre del producto">
              </div>
              <div class="mb-3">
              <label for="inputProductDescription" class="form-label">Descripcion</label>
              <textarea name="description" class="form-control" id="inputProductDescription" rows="3"></textarea>
              </div>
              <div class="mb-3">
              <label for="inputProductDescription" class="form-label">Imagen Principal</label>
              <input id="image-uploadify" type="file" name="photo">
              </div>
                          </div>
             </div>
             <div class="col-lg-4">
            <div class="border border-3 p-4 rounded">
                            <div class="row g-3">
              <div class="col-md-12">
                <label for="inputPrice" class="form-label">Puntos</label>
                <input type="text" name="points" class="form-control" id="inputPrice" placeholder="">
                </div>
                <div class="col-12">
                <label for="inputProductType" class="form-label">Categoria</label>
                <select class="form-select" name="category" id="inputProductType">
                  <option></option>
                  <option value="1">Muebles</option>
                  <option value="2">Electronica</option>
                  <option value="3">hogar</option>
                  </select>
                </div>
                <div class="col-12">
                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                  </div>
                </div>
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
