@extends('layouts.app')
@section('content')
<div class="wrapper">
  <!--sidebar wrapper -->
@include('partials.sidebar')
  <!--end sidebar wrapper -->
  <!--start page wrapper -->
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <div class="col">
          <div class="card radius-10">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div>
                  <p class="mb-0 text-secondary">Puntos Acumulados</p>
                  @if(isset($totalpoints[0]->suma))
                  <h4 class="my-1"> <?php echo abs($totalpoints[0]->suma - $totalpoints[1]->suma); ?> Pts.</h4>
                  @else
                  <h4 class="my-1"> 0 Pts.</h4>
                  @endif
                </div>
                <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-wallet'></i>
                </div>
              </div>
              <div id="chart1"></div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card radius-10">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div>
                  <p class="mb-0 text-secondary">Ordenes Cargadas</p>
                  <h4 class="my-1">{{$ordercant}}</h4>
                </div>
                <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class='bx bxs-group'></i>
                </div>
              </div>
              <div id="chart2"></div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card radius-10">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div>
                  <p class="mb-0 text-secondary">Canjes Realizados</p>
                  <h4 class="my-1">{{$changescant}}</h4>
                </div>
                <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-binoculars'></i>
                </div>
              </div>
              <div id="chart3"></div>
            </div>
          </div>
        </div>
      </div>
      <!--end row-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card radius-10">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div>
                  <h5 class="mb-0">Últimas ordenes cargadas</h5>
                </div>
                <div class="font-22 ms-auto">
                  <a href="#" class="btn btn-default">ver todas</a>
                </div>
              </div>
              <hr/>
              <div class="table-responsive">
                <table id="" class="table align-middle mb-0 table-hover table-bordered">
                    <thead class="table-light">
                    <tr>
                      <th>Nº de Factura</th>
                      <th>Fecha de carga</th>
                      <th>Factura</th>
                      <th>Monto Factura</th>
                      <th>Puntos</th>
                      <th>Status</th>
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
                      <td>
                        @if($ordersItem->points)
                        <div class="d-flex align-items-center text-success">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
												    <span>Autorizado</span>
											  </div>
                        @else
                        <div class="d-flex align-items-center text-danger">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
												   <span>Validando</span>
						            </div>
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
      <!--end row-->
      <div class="row">
        <div class="col-xl-8 d-flex">
          <div class="card radius-10 w-100">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div>
                  <h5 class="mb-1">Últimos movimientos de puntos</h5>
                  <p class="mb-0 font-13 text-secondary"><i class='bx bxs-calendar'></i>En los ultimos 30 días</p>
                </div>
                <div class="font-22 ms-auto">
                  <a href="#" class="btn btn-default">ver todos</a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive mt-4">
                  <table class="table align-middle mb-0 table-hover table-bordered" id="Transaction-History">
                    <thead class="table-light">
                      <tr>
                      <th>Fecha de carga</th>
                        <th>Nº de Factura</th>

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
        <div class="col d-flex">
          <div class="card radius-10 w-100">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div>
                  <h5 class="mb-1">Nuevos productos</h5>
                  <p class="mb-0 font-13 text-secondary"><i class='bx bxs-calendar'></i>Novedades recien agregadas</p>
                </div>
                <div class="font-22 ms-auto">
                  <a href="#" class="btn btn-default">ver todos</a>
                </div>
              </div>
            </div>
              <div class="product-list p-3 mb-3">
                  @forelse($products as $productsItem)
                <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
                  <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                      <div class="product-img">
                        <img src="{{url('/')}}/assets/images/products/{{$productsItem->photo}}" alt="" />
                      </div>
                      <div class="ms-2">
                        <h6 class="mb-1">{{$productsItem->title}} Pts.</h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm">
                      <h6 class="mt-1">{{$productsItem->points}} Pts.</h6>
                  </div>
                </div>
                @empty
                @endforelse
                </div>
            </div>
          </div>
        </div>
      </div>
      <!--end row-->
    </div>
  </div>
  <!--end page wrapper -->
  <!--start overlay-->
  <div class="overlay toggle-icon"></div>
  <!--end overlay-->
  <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
  <!--End Back To Top Button-->
  <footer class="page-footer">
    <p class="mb-0">Copyright © 2021. All right reserved.</p>
  </footer>
</div>
@endsection
