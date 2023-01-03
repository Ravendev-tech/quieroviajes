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
          <div class="">
            <div class="row" >
              <div class="col-6">
                <h5 class="mb-0 mt-2">pagos registrados el: {{$date}}</h5>
              </div>
              <div class="col-6">
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
                  <td class="text-center" > <input <?php if($dailyItems->payments_checked == 1){echo "checked";}  ?> type="checkbox" name="" value="{{$dailyItems->id_payments}}" onclick="sendcheck(this.value)">  </td>
                </tr>

                @empty
                @endforelse
              </tbody>
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
  function getdaily(val){
    console.log(val)
    window.location.href = '{{url('/')}}/daily/'+val;
  }



function sendcheck(id) {
    var token = '{{csrf_token()}}';
    var idpayment = id;
    var data={idpayment:idpayment,_token:token};
    $.ajax({
       type:'post',
       url:"{{route('checkdaily')}}",
       data: data,
       success: function(data){
        }
    });
}












</script>
@endsection
