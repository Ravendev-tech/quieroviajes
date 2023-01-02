@extends('layouts.app')
@section('content')
<div class="wrapper">
  <!--sidebar wrapper -->
@include('partials.sidebar')
<div class="page-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-xl-8 mx-auto">
      <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body p-4">
          <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Detalles de expediente</h5>
          </div>
          <hr>
          @if(session()->has('success'))
              <div class="alert alert-success">
                  {{ session()->get('success') }}
              </div>
          @endif
          <form class="row g-3" action="{{route('travels.store')}}" method="post">
            @csrf
              <p class="mb-0 text-primary">Datos del Viaje</p>
            <div class="col-md-4">
              <p><b>Localizador</b></p>
              <p>{{$datatravel[0]->localizador}}</p>
            </div>
            <div class="col-md-4">
              <p><b>Fecha de Salida:</b></p>
              <p>{{$datatravel[0]->date_departure}}</p>
            </div>
            <div class="col-md-4">
              <p><b>Fecha de regreso:</b></p>
              <p>{{$datatravel[0]->date_arrival}}</p>
            </div>

            <div class="col-lg-6 mt-4">
              <div class="mb-3">
                <p><b>Origen:</b></p>
                <p>{{$datatravel[0]->destinationfrom}}</p>
                </div>
             </div>
             <div class="col-lg-6  mt-4">
               <div class="mb-3">
                 <p><b>Destino:</b></p>
                 <p>{{$datatravel[0]->destinationto}}</p>
                 </div>
              </div>

            <div class="col-12">
              <p><b>Observaciones:</b></p>
              <p>{{$datatravel[0]->travel_details}}</p>
            </div>

            <p class="mb-0 text-primary">Datos del Pasajero</p>
            <hr>
              <table id="myTable" class=" table order-list">
                <thead>
                    <tr>
                        <td><b>Nombre Completo</b> </td>
                        <td><b>Telefono</b> </td>
                        <td><b>Neto</b> </td>
                        <td><b>PVP</b> </td>
                    </tr>
                </thead>
                <tbody>
                  @forelse($datatravel as $datatravelItem)
                  <tr>
                    <td class="col-sm-5">
                        <p>{{$datatravelItem->client_fullname}}</p>
                    </td>
                    <td class="col-sm-3">
                        <p>{{$datatravelItem->client_phone}}</p>
                    </td>
                    <td class="col-sm-2">
                      <p>{{$datatravelItem->travel_neto}}€</p>
                    </td>
                    <td class="col-sm-2">
                      <p>{{$datatravelItem->travel_pvp}}€</p>
                    </td>
                  </tr>
                  @empty
                  @endforelse
                  <tr class="backbkack">
                    <td></td>
                    <td></td>
                    <td><b>Total:</b> </td>
                    <td><b>{{$amount}}€</b> </td>
                  </tr>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            <input type="hidden" name="counter" id="counter" value="">
          </form>
        </div>
      </div>
      </div>

      <!-- payment -->
      <!-- if no payments  -->
      @if($haspayment == 0)
      <div class="col-xl-8 mx-auto">
      <form class="" action="{{route('payment.store')}}" method="post">
        @csrf
      <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body p-4">
          <div class="card-title d-flex align-items-center mb-3">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Detalle de Pagos</h5>
          </div>
          <hr>
          <div class="col-md-12">
            <p><b>Cantidad de Pago</b></p>
            <div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="cantpagos" id="pago1" value="1" checked onchange="pagos(this.value)">
							<label class="form-check-label" for="pago1">1 pago</label>
						</div>
            <div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="cantpagos" id="pago2" value="2"  onchange="pagos(this.value)">
							<label class="form-check-label" for="pago2">2 pagos</label>
						</div>
            <div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="cantpagos" id="pago3" value="3"  onchange="pagos(this.value)">
							<label class="form-check-label" for="pago3">3 pagos</label>
						</div>
          </div>
          <hr>
            <div class="col-lg-12">
              <p><b>Fecha y Metodo de Pago</b></p>
              <table id="myTable" class=" table order-list">
                <thead>
                    <tr>
                        <td><b>Fecha</b> </td>
                        <td><b>Método</b> </td>
                        <td><b>Monto</b> </td>
                        <td class="text-center"><b>Estado</b> </td>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="col-sm-4">
                        <input type="date" class="form-control" name="fecha1" id="fecha1" onchange="validafecha1(this.value)">
                    </td>
                    <td class="col-sm-4">
                      <div class="input-group">
                        <select class="form-select single-select" name="method1" required>
                          <option selected value="">Forma de Pago</option>
                          <option value="Bizum - BBVA">Bizum - BBVA</option>
                          <option value="Buzum - Santander">Buzum - Santander</option>
                          <option value="Trasnferencia Santander">Trasnferencia Santander</option>
                          <option value="Transferencia BBVA">Transferencia BBVA</option>
                          <option value="Transferencia CAIXA BANK">Transferencia CAIXA BANK</option>
                          <option value="Transferencia Banco Popular Dominicano">Transferencia Banco Popular Dominicano</option>
                          <option value="Trajeta Santander">Trajeta Santander</option>
                          <option value="Tarjeta BBVA">Tarjeta BBVA</option>
                          <option value="Tarjeta CAIZA bank Fisico">Tarjeta CAIZA bank Fisico</option>
                          <option value="Efectivo">Efectivo</option>
                        </select>
                      </div>
                    </td>
                    <td class="col-sm-2">
                        <input type="number" step="any" name="total1"  class="form-control " id="total1" value="{{$amount}}" required/>
                    </td>
                    <td class="col-sm-2 text-center">
                      <input type="checkbox" class="form-check-input pagado" name="status1" value="1" checked>
                    </td>
                  </tr>
                  <tr id="rowpago2" style="display:none">
                    <td class="col-sm-4">
                        <input type="date" class="form-control" name="fecha2" id="fecha2" onchange="validafecha2(this.value)" >
                    </td>
                    <td class="col-sm-4">
                      <div class="input-group">
                        <select class="form-select single-select" name="method2" >
                          <option selected value="">Forma de Pago</option>
                          <option value="Bizum - BBVA">Bizum - BBVA</option>
                          <option value="Buzum - Santander">Buzum - Santander</option>
                          <option value="Trasnferencia Santander">Trasnferencia Santander</option>
                          <option value="Transferencia BBVA">Transferencia BBVA</option>
                          <option value="Transferencia CAIXA BANK">Transferencia CAIXA BANK</option>
                          <option value="Transferencia Banco Popular Dominicano">Transferencia Banco Popular Dominicano</option>
                          <option value="Trajeta Santander">Trajeta Santander</option>
                          <option value="Tarjeta BBVA">Tarjeta BBVA</option>
                          <option value="Tarjeta CAIZA bank Fisico">Tarjeta CAIZA bank Fisico</option>
                          <option value="Efectivo">Efectivo</option>
                        </select>
                      </div>
                    </td>
                    <td class="col-sm-2">
                        <input type="number" step="any" name="total2"  class="form-control " id="total2" />
                    </td>
                    <td class="col-sm-2">
                      <!-- <button type="button" class="btn btn-outline-danger"><i class="bx bx-blanket me-0"></i></button> -->
                    </td>
                  </tr>
                  <tr id="rowpago3" style="display:none">
                    <td class="col-sm-4">
                        <input type="date" class="form-control" name="fecha3" id="fecha3" onchange="validafecha3(this.value)" >
                    </td>
                    <td class="col-sm-4">
                      <div class="input-group">
                        <select class="form-select single-select" name="method3" >
                          <option selected value="">Forma de Pago</option>
                          <option value="Bizum - BBVA">Bizum - BBVA</option>
                          <option value="Buzum - Santander">Buzum - Santander</option>
                          <option value="Trasnferencia Santander">Trasnferencia Santander</option>
                          <option value="Transferencia BBVA">Transferencia BBVA</option>
                          <option value="Transferencia CAIXA BANK">Transferencia CAIXA BANK</option>
                          <option value="Transferencia Banco Popular Dominicano">Transferencia Banco Popular Dominicano</option>
                          <option value="Trajeta Santander">Trajeta Santander</option>
                          <option value="Tarjeta BBVA">Tarjeta BBVA</option>
                          <option value="Tarjeta CAIZA bank Fisico">Tarjeta CAIZA bank Fisico</option>
                          <option value="Efectivo">Efectivo</option>
                        </select>
                      </div>
                    </td>
                    <td class="col-sm-2">
                        <input type="number" step="any" name="total3"  class="form-control " id="total3" />
                    </td>
                    <td class="col-sm-2">
                      <!-- <button type="button" class="btn btn-outline-danger"><i class="bx bx-blanket me-0"></i></button> -->
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            <div class="text-end">
              <input type="hidden" name="localizador" value="{{$datatravel[0]->localizador}}">
              <input type="submit" name="" class="btn btn-primary" value="GUARDAR">
            </div>
            </div>
            <!-- end no payments -->
        </div>
      </div>
      </form>
      </div>
      @else
      <div class="col-xl-8 mx-auto">
      <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body p-4">
          <div class="card-title d-flex align-items-center mb-3">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Detalle de Pagos</h5>
          </div>
          <hr>
            <div class="col-lg-12">
              <form class="" action="{{route('payment.update')}}"  enctype="multipart/form-data" method="post">
                @method('PATCH')
                @csrf
              <p><b>Fecha,Metodo de Pago e Hitos</b></p>
              <table id="myTable" class=" table order-list">
                <thead>
                    <tr>
                        <td><b>Fecha</b> </td>
                        <td><b>Método</b> </td>
                        <td><b>Monto</b> </td>
                        <td class="text-center"><b>Estado</b> </td>
                    </tr>
                </thead>
                <tbody>
                  <?php $position = 1 ?>
                  @forelse($payment as $paymentItem)
                  <tr>
                    <td class="col-sm-4">
                        {{$paymentItem->payment_date}}
                    </td>
                    <td class="col-sm-4">
                        {{$paymentItem->payment_method}}
                    </td>
                    <td class="col-sm-2">
                        {{$paymentItem->payment_amount}}€
                    </td>
                    <td class="col-sm-2 text-center">
                      @if($paymentItem->payment_status == 0)
                      <input type="checkbox" class="form-check-input pagado" name="v{{$position}}" value="{{$paymentItem->id_payments}}" >
                      @elseif($paymentItem->payment_status == 2)
                      <span class="text-primary" ><i class="lni lni-flag-alt primary"></i> Hito</span>
                      @else
                      <a href="{{route('paymentrecipet',$paymentItem->id_payments)}}" target="_blank"><i class="lni lni-printer"></i> Pagado</a>
                      @endif
                    </td>
                  </tr>
                    <?php $position++ ?>
                  @empty
                  @endforelse
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            @if($paymentItem->payment_status == 0)
            <div class="text-end">
              <input type="submit" name="" class="btn btn-primary" value="GUARDAR">
              <button type="button" class="btn btn-outline-primary"><i class="lni lni-printer me-0"></i></button>
            </div>
            @else
            @endif
            <table id="myTable" class=" table order-list">
              <thead>
                  <tr>
                      <td><b></b> </td>
                      <td><b></b> </td>
                      <td><b></b> </td>
                      <td class="text-center"><b>Resumen</b> </td>
                  </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="col-sm-4">
                  </td>
                  <td class="col-sm-4">
                  </td>
                  <td class="col-sm-2 text-end">
                    Total a Pagar:
                  </td>
                  <td class="col-sm-2 text-center">
                    <b>{{$amount}}€</b>
                  </td>
                </tr>
                <tr>
                  <td class="col-sm-4">
                  </td>
                  <td class="col-sm-4">
                  </td>
                  <td class="col-sm-2 text-end">
                    Total Pagado:
                  </td>
                  <td class="col-sm-2 text-center">
                    <b>{{$amountpaid}}€</b>
                  </td>
                </tr>
                <tr>
                  <td class="col-sm-4">
                  </td>
                  <td class="col-sm-4">
                  </td>
                  <td class="col-sm-2 text-end">
                    Restante a Pagar:
                  </td>
                  <td class="col-sm-2 text-center">
                    <b>{{$amount - $amountpaid}}€</b>
                  </td>
                </tr>
              </tbody>
              <tfoot>
              </tfoot>
          </table>
            </form>
            <form class="" action="{{route('payment.store')}}" method="post">
              @csrf
              <p class="text-primary" ><b>Agregar Pago</b></p>
              <table id="myTable" class=" table order-list">
                <thead>
                    <tr>
                        <td><b>Fecha</b> </td>
                        <td><b>Método</b> </td>
                        <td><b>Monto</b> </td>
                        <td class="text-center"><b>Accion</b> </td>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="col-sm-4">
                        <input type="date" class="form-control" name="fecha1" required >
                    </td>
                    <td class="col-sm-4">
                      <select class="form-select single-select" name="method1" required >
                        <option selected value="">Forma de Pago</option>
                        <option value="Bizum - BBVA">Bizum - BBVA</option>
                        <option value="Buzum - Santander">Buzum - Santander</option>
                        <option value="Trasnferencia Santander">Trasnferencia Santander</option>
                        <option value="Transferencia BBVA">Transferencia BBVA</option>
                        <option value="Transferencia CAIXA BANK">Transferencia CAIXA BANK</option>
                        <option value="Transferencia Banco Popular Dominicano">Transferencia Banco Popular Dominicano</option>
                        <option value="Trajeta Santander">Trajeta Santander</option>
                        <option value="Tarjeta BBVA">Tarjeta BBVA</option>
                        <option value="Tarjeta CAIZA bank Fisico">Tarjeta CAIZA bank Fisico</option>
                        <option value="Efectivo">Efectivo</option>
                      </select>
                    </td>
                    <td class="col-sm-2">
                      <input type="number" step="any" name="total1" max="{{$amount - $amountpaid}}" class="form-control " required>
                    </td>
                    <td class="col-sm-2 text-center">
                      <input type="submit" name="" class="btn btn-primary" value="GUARDAR">
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            <input class="form-check-input" type="hidden" name="cantpagos"  value="1">
            <input class="form-check-input" type="hidden" name="status1"  value="1">
            <input type="hidden" name="localizador" value="{{$datatravel[0]->localizador}}">
            </form>
            </div>
            <!-- end no payments -->
        </div>
      </div>
      </div>
      @endif
      <!-- end payment -->
    </div>
  </div>
</div>

@endsection
@section('scripts')

<script type="text/javascript">
  $(document).ready(function(){
    var departure = "<?php echo $datatravel[0]->date_departure ?>";
    var today = "<?php echo date('Y-m-d') ?>" ;
    var nextmont = "<?php  echo date("Y-m-d",strtotime(date('Y-m-d')."+ 1 month"));  ?>" ;
    var nextnextmont = "<?php  echo date("Y-m-d",strtotime(date('Y-m-d')."+ 2 month"));  ?>" ;
    $('#fecha1').val(today);
    $('#fecha2').val(nextmont);
    $('#fecha3').val(nextnextmont);

    if(departure < nextmont ){
      $("#fecha2").css("background-color", "red");
    }

    if(departure < nextnextmont ){
      $("#fecha3").css("background-color", "red");
    }

  });

  function validafecha1(fecha){
      var departure = "<?php echo $datatravel[0]->date_departure ?>";
      console.log(departure);
      console.log(fecha)
      if(departure > fecha ){
        $("#fecha1").css("background-color", "white");
      }
      else{
        $("#fecha1").css("background-color", "red");
      }
  }

  function validafecha2(fecha){
      var departure = "<?php echo $datatravel[0]->date_departure ?>";
      console.log(departure);
      console.log(fecha)
      if(departure > fecha ){
        $("#fecha2").css("background-color", "white");
      }
      else{
        $("#fecha2").css("background-color", "red");
      }
  }

  function validafecha3(fecha){
      var departure = "<?php echo $datatravel[0]->date_departure ?>";
      console.log(departure);
      console.log(fecha)
      if(departure > fecha ){
        $("#fecha3").css("background-color", "white");
      }
      else{
        $("#fecha3").css("background-color", "red");
      }
  }

  function pagos(pagos){

    var amount = "<?php echo $amount?>";

    console.log(pagos)
    if(pagos == 1){
      $("#rowpago2").css("display", "none");
      $("#rowpago3").css("display", "none");

      var finalamount = amount;
    }
    if(pagos == 2){
      $("#rowpago2").css("display", "table-row");
      $("#rowpago3").css("display", "none");

      var finalamount = amount / 2;
    }
    if(pagos == 3){
      $("#rowpago2").css("display", "table-row");
      $("#rowpago3").css("display", "table-row");

      var finalamount = amount / 3;
    }
    $('#total1').val(finalamount);
    $('#total2').val(finalamount);
    $('#total3').val(finalamount);

  }


</script>

@endsection
