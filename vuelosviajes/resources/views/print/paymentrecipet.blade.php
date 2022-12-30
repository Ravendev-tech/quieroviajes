@extends('layouts.app')
@section('css')
<style media="screen">
  *{
    font-size:14px
  }
</style>
@endsection
@section('content')
<div class="">
  <div class="wrapper">
    <!--sidebar wrapper -->
          <div class="row">
            <div class="col-6">
              <img src="{{url('/')}}/assets/images/logodelyar.png" width="230px"  class="" alt="logo icon">
            </div>
            <div class="col-6 text-end" style="">
              Querio Caribe SL<br>
              Av. Oporto 24, Madrid<br>
              CIF: B88229778<br>
              CICMA: 3892 <br>
              Tel: 910 059 014<br>
              CP: 28019
            </div>

          </div>
        <div class="">
        <form class="" action="{{route('product.store')}}" enctype="multipart/form-data" method="post">
          @csrf
          <div class="card-body p-4">
            <h5 class="card-title">Recibo N° {{$datapayment[0]->id_payments}}</h5>
            <hr/>
             <div class="form-body mt-4">
              <div class="row">
               <div class="col-lg-12">
                 Hemos recibido de:  # {{$datapayment[0]->client_fullname}}  # <br>
                 La cantidad de: <span id="text" ></span>  <br>
                 En concepto de: ENTREGA por servicios solicitados en el expediente: #{{$datapayment[0]->id_travels}} <br>
                 Por: {{$datapayment[0]->client_fullname}}  | {{$datapayment[0]->destfrom}} - {{$datapayment[0]->destto}} | {{$datapayment[0]->date_departure}}
               </div>
             </div><!--end row-->
             <hr/>
             <div class="row">
               <div class="col-lg-4">
                 importe: {{$datapayment[0]->payment_amount }}€
               </div>
               <div class="col-lg-4">
                 <?php
                 $checkpaid = App\Http\Controllers\PaymentController::checkpaid($datapayment[0]->localizador);
                 $checktotal = App\Http\Controllers\PaymentController::checktotal($datapayment[0]->localizador);
                 ?>
                 importe del viaje: {{$checktotal}}€ <br>
                 importe pendiente:  {{$checkpaid}}€<br>
               </div>
               <div class="col-lg-4">
                 Fecha: <?php echo date('Y-m-d') ?> <br>
                 Forma de Pago: {{$datapayment[0]->payment_method}}
               </div>
             </div>
             <hr/>
          </div>
          </div>
        </form>
      </div>

  </div>
</div>
@endsection


@section('scripts')

<script type="text/javascript">
var numeroALetras = (function() {
  // Código basado en el comentario de @sapienman
  // Código basado en https://gist.github.com/alfchee/e563340276f89b22042a
  function Unidades(num) {

      switch (num) {
          case 1:
              return 'UN';
          case 2:
              return 'DOS';
          case 3:
              return 'TRES';
          case 4:
              return 'CUATRO';
          case 5:
              return 'CINCO';
          case 6:
              return 'SEIS';
          case 7:
              return 'SIETE';
          case 8:
              return 'OCHO';
          case 9:
              return 'NUEVE';
      }

      return '';
  } //Unidades()

  function Decenas(num) {

      let decena = Math.floor(num / 10);
      let unidad = num - (decena * 10);

      switch (decena) {
          case 1:
              switch (unidad) {
                  case 0:
                      return 'DIEZ';
                  case 1:
                      return 'ONCE';
                  case 2:
                      return 'DOCE';
                  case 3:
                      return 'TRECE';
                  case 4:
                      return 'CATORCE';
                  case 5:
                      return 'QUINCE';
                  default:
                      return 'DIECI' + Unidades(unidad);
              }
          case 2:
              switch (unidad) {
                  case 0:
                      return 'VEINTE';
                  default:
                      return 'VEINTI' + Unidades(unidad);
              }
          case 3:
              return DecenasY('TREINTA', unidad);
          case 4:
              return DecenasY('CUARENTA', unidad);
          case 5:
              return DecenasY('CINCUENTA', unidad);
          case 6:
              return DecenasY('SESENTA', unidad);
          case 7:
              return DecenasY('SETENTA', unidad);
          case 8:
              return DecenasY('OCHENTA', unidad);
          case 9:
              return DecenasY('NOVENTA', unidad);
          case 0:
              return Unidades(unidad);
      }
  } //Unidades()

  function DecenasY(strSin, numUnidades) {
      if (numUnidades > 0)
          return strSin + ' Y ' + Unidades(numUnidades)

      return strSin;
  } //DecenasY()

  function Centenas(num) {
      let centenas = Math.floor(num / 100);
      let decenas = num - (centenas * 100);

      switch (centenas) {
          case 1:
              if (decenas > 0)
                  return 'CIENTO ' + Decenas(decenas);
              return 'CIEN';
          case 2:
              return 'DOSCIENTOS ' + Decenas(decenas);
          case 3:
              return 'TRESCIENTOS ' + Decenas(decenas);
          case 4:
              return 'CUATROCIENTOS ' + Decenas(decenas);
          case 5:
              return 'QUINIENTOS ' + Decenas(decenas);
          case 6:
              return 'SEISCIENTOS ' + Decenas(decenas);
          case 7:
              return 'SETECIENTOS ' + Decenas(decenas);
          case 8:
              return 'OCHOCIENTOS ' + Decenas(decenas);
          case 9:
              return 'NOVECIENTOS ' + Decenas(decenas);
      }

      return Decenas(decenas);
  } //Centenas()

  function Seccion(num, divisor, strSingular, strPlural) {
      let cientos = Math.floor(num / divisor)
      let resto = num - (cientos * divisor)

      let letras = '';

      if (cientos > 0)
          if (cientos > 1)
              letras = Centenas(cientos) + ' ' + strPlural;
          else
              letras = strSingular;

      if (resto > 0)
          letras += '';

      return letras;
  } //Seccion()

  function Miles(num) {
      let divisor = 1000;
      let cientos = Math.floor(num / divisor)
      let resto = num - (cientos * divisor)

      let strMiles = Seccion(num, divisor, 'UN MIL', 'MIL');
      let strCentenas = Centenas(resto);

      if (strMiles == '')
          return strCentenas;

      return strMiles + ' ' + strCentenas;
  } //Miles()

  function Millones(num) {
      let divisor = 1000000;
      let cientos = Math.floor(num / divisor)
      let resto = num - (cientos * divisor)

      let strMillones = Seccion(num, divisor, 'UN MILLON DE', 'MILLONES DE');
      let strMiles = Miles(resto);

      if (strMillones == '')
          return strMiles;

      return strMillones + ' ' + strMiles;
  } //Millones()

  return function NumeroALetras(num, currency) {
      currency = currency || {};
      let data = {
          numero: num,
          enteros: Math.floor(num),
          centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
          letrasCentavos: '',
          letrasMonedaPlural: currency.plural || 'EUROS', //'PESOS', 'Dólares', 'Bolívares', 'etcs'
          letrasMonedaSingular: currency.singular || 'EURO', //'PESO', 'Dólar', 'Bolivar', 'etc'
          letrasMonedaCentavoPlural: currency.centPlural || 'CENTS',
          letrasMonedaCentavoSingular: currency.centSingular || 'CENTS'
      };

      if (data.centavos > 0) {
          data.letrasCentavos = 'CON ' + (function() {
              if (data.centavos == 1)
                  return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoSingular;
              else
                  return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoPlural;
          })();
      };

      if (data.enteros == 0)
          return 'CERO ' + data.letrasMonedaPlural + ' ' + data.letrasCentavos;
      if (data.enteros == 1)
          return Millones(data.enteros) + ' ' + data.letrasMonedaSingular + ' ' + data.letrasCentavos;
      else
          return Millones(data.enteros) + ' ' + data.letrasMonedaPlural + ' ' + data.letrasCentavos;
  };

})();
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#text').text(numeroALetras( <?php echo $datapayment[0]->payment_amount ?> ));

    setTimeout(
  function()
  {
    window.print();
  }, 1000);
  });
</script>
@endsection
