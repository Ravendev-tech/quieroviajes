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
          <div class="">
            <div class="row" >
              <div class="col-lg-4">
                <h5 class="mb-0">pagos registrados el: {{$date}}</h5>
              </div>
              <div class="col-lg-4">
                <input type="date" class="form-control" name="fecha1" value="{{$date}}" onchange="getdaily(this.value)">
              </div>
            </div>
            <div class="font-22 ms-auto">
            </div>
          </div>
          <hr/>
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>Fecha</th>
                  <th>Cliente</th>
                  <th>Método de pago</th>
                  <th>Monto</th>
                  <th>Usuario</th>
                  <th class="text-center" >Check</th>
                </tr>
              </thead>
              <tbody>
                @forelse($daily as $dailyItems)
                <tr>
                  <td>{{$dailyItems->created_at}}</td>
                  <td>{{$dailyItems->client_fullname}}</td>
                  <td>{{$dailyItems->payment_method}}</td>
                  <td>{{$dailyItems->payment_amount}}€</td>
                  <td>{{$dailyItems->name}}</td>
                  <td class="text-center" > <input type="checkbox" name="" value=""> </td>
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
  function getdaily(val){
    console.log(val)
    window.location.href = 'http://127.0.0.1:8000/daily/'+val;
  }
</script>
@endsection
