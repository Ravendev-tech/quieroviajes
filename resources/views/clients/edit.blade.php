@extends('layouts.app')
@section('content')
<div class="wrapper">
  <!--sidebar wrapper -->
@include('partials.sidebar')

<div class="page-wrapper">
  <div class="page-content">
    <div class="container">
      <div class="main-body">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <ul class="nav nav-tabs nav-primary" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" data-bs-toggle="tab" href="#personaldata" role="tab" aria-selected="true">
                    <div class="d-flex align-items-center">
                      <div class="tab-icon"><i class="lni lni-user"> </i>
                      </div>
                      <div class="tab-title"> Datos Personales</div>
                    </div>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" data-bs-toggle="tab" href="#orders" role="tab" aria-selected="false">
                    <div class="d-flex align-items-center">
                      <div class="tab-icon"><i class="lni lni-plane"></i>
                      </div>
                      <div class="tab-title"> Viajes/Vuelos Cargados</div>
                    </div>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" data-bs-toggle="tab" href="#reports" role="tab" aria-selected="false">
                    <div class="d-flex align-items-center">
                      <div class="tab-icon"><i class="fadeIn animated bx bx-bar-chart"></i>
                      </div>
                      <div class="tab-title"> Reportes</div>
                    </div>
                  </a>
                </li>
              </ul>
              <div class="tab-content py-3">
                <div class="tab-pane fade show active" id="personaldata" role="tabpanel">
                    <!-- user data -->
                    <div class="row">
                      <div class="col-lg-12">
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                      </div>
                      <div class="col-lg-4">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                              <div class="avatarimage" style="background:url('{{url('/')}}/assets/images/avatars/{{$client[0]->user_avatar}}')">

                              </div>
                              <form class="" action="{{route('avatarupdate')}}"  enctype="multipart/form-data" method="post">
                                @method('PATCH')
                                @csrf
                                <label for="getFile" class="file mt-2 btn btn-primary">Cambiar Imagen</label>
                                <input class="" type='file' id="getFile" style="display:none"  name="avatar" accept="image/png, image/jpeg" onchange="this.form.submit()">
                                <input type="hidden" name="userid" value="{{$client[0]->id}}">
                              </form>
                              <div class="mt-3">
                                <h4>{{$client[0]->name}}</h4>
                                <p class="text-secondary mb-1">{{$client[0]->address}}, {{$client[0]->city}}</p>
                                <p class="text-muted font-size-sm">{{$client[0]->whatsapp}}</p>
                              </div>
                            </div>
                            <hr class="my-4" />
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Ventas en el Mes</h6>
                                <span class="text-secondary">{{$ordercant}}</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Viajes Cargados</h6>
                                <span class="text-secondary">{{$ordercant}}</span>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-8">
                      <form class="" action="{{route('clients.update',$client[0]->id)}}"  enctype="multipart/form-data" method="post">
                        @method('PATCH')
                        @csrf
                            <div class="card">
                              <div class="card-body">
                                <div class="row mb-3">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Nombre Completo</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="name" value="{{$client[0]->name}}" />
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" value="{{$client[0]->email}}" disabled />
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Telefono</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="phone" value="{{$client[0]->phone}}" />
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Whatsapp</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="whatsapp" value="{{$client[0]->whatsapp}}" />
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Constrase??a</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="address" value="{{$client[0]->address}}" />
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-3"></div>
                                  <div class="col-sm-9 text-secondary text-end">
                                    <input type="submit" class="btn btn-primary px-4" value="Guardar cambios" />
                                  </div>
                                </div>
                              </div>
                            </div>
                      </form>
                      </<div>
                    </div>
                    <!-- end user data -->
                </div>
              </div>
              <!-- orders -->
              <div class="tab-pane fade" id="orders" role="tabpanel">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="example" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>N?? de Factura</th>
                            <th>Fecha de carga</th>
                            <th>Factura</th>
                            <th>Monto</th>
                            <th>Puntos</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($orders as $ordersItem)
                          <tr>
                            <td>{{$ordersItem->nro_invoice}}</td>
                            <td>{{ date("d-m-Y", strtotime($ordersItem->created_at)) }}</td>
                            <td><a href="{{url('/')}}/assets/orders/{{$ordersItem->file_invoice}}" target="_blank"><i class="lni lni-empty-file"></i> </a></td>
                            <td>{{$ordersItem->amount_invoice}}</td>
                            <td>
                              <!-- validation if  has points or not, so, show the points or the form -->
                              @if($ordersItem->points)
                              {{$ordersItem->points}}
                              @else
                              Esperando Validacion
                              @endif
                            </td>
                          </tr>
                          @empty
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end orders -->
              <div class="tab-pane fade" id="reports" role="tabpanel">
              <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="example" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                          <th>Fecha de carga</th>
                            <th>N?? de Factura</th>

                            <th>Accion</th>
                            <th>Puntos</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($points as $pointsItem)
                          <tr>
                            <td>{{ date("d-m-Y", strtotime($pointsItem->created_at)) }}</td>
                            <td>{{$pointsItem->nro_invoice}}</td>

                            <td>
                            @if($pointsItem->action == "add")
                            Ingreso
                            @else
                            Egreso
                            @endif
                            </td>
                            <td>
                              @if($pointsItem->action == "add")
                              + {{$pointsItem->points}}
                              @else
                              - {{$pointsItem->points}}
                              @endif
                            </td>
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
        </div>
      </div>
    </div>
  </div>
</div>




@endsection
