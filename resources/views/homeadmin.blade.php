@extends('layouts.app')
@section('content')
<div class="wrapper">
  <!--sidebar wrapper -->
@include('partials.sidebar')
  <!--end sidebar wrapper -->
  <!--start header -->
  <!--end header -->
  <!--start page wrapper -->
  <div class="page-wrapper">
    <div class="page-content">
      <!-- <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <div class="col">
          <div class="card radius-10">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div>
                  <p class="mb-0 text-secondary">Ventas en el mes</p>
                  <h4 class="my-1">4805 €</h4>
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
                  <p class="mb-0 text-secondary">Total por cobrar</p>
                  <h4 class="my-1">8.4K</h4>
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
                  <p class="mb-0 text-secondary">Pasajes vendidos</p>
                  <h4 class="my-1">800</h4>
                </div>
                <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-binoculars'></i>
                </div>
              </div>
              <div id="chart3"></div>
            </div>
          </div>
        </div>
      </div> -->
      <!--end row-->
      <!--end row-->
      <!--end row-->
      <!--end row-->
      <!--end row-->
      <div class="card radius-10">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <h5 class="mb-0">Vencen en los proximos 15 dias.</h5>
            </div>
            <div class="font-22 ms-auto">
            </div>
          </div>
          <hr/>
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>Orden ID</th>
                  <th>Localizador</th>
                  <th>Cliente</th>
                  <th>Fecha de Salida</th>
                  <th>Deuda</th>
                  <th>Ver</th>
                </tr>
              </thead>
              <tbody>
                @forelse($nextpayments as $nextpaymentstem)

                <?php
                $checkpaid = App\Http\Controllers\PaymentController::checkpaid($nextpaymentstem->localizador);
                $checktotal = App\Http\Controllers\PaymentController::checktotal($nextpaymentstem->localizador);
                ?>

                @if($checkpaid < $checktotal)
                <tr>
                  <td>#{{$nextpaymentstem->id_travels}}</td>
                  <td>
                    {{$nextpaymentstem->localizador}}
                  </td>
                  <td>{{$nextpaymentstem->client_fullname}}</td>
                  <td>{{$nextpaymentstem->date_departure}}</td>
                  <td> <?php echo $checktotal - $checkpaid ?>€ </td>
                  <td>
                        @if(is_null($nextpaymentstem->localizador))
                        <a href="{{route('payment.edit',$nextpaymentstem->localizador)}}"><i class="lni lni-money-location bnt-danger"></i></a>
                        @else
                        <a href="{{route('payment.edit',$nextpaymentstem->localizador)}}"><i class="lni lni-wallet"></i></a>
                        @endif
                  </td>
                </tr>
                @else
                @endif

                @empty
                @endforelse
              </tbody>
            </table>
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
  <footer class="page-footer">
    <p class="mb-0">Copyright © 2021. All right reserved.</p>
  </footer>
</div>
@endsection
