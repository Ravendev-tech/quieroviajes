@extends('layouts.app')
@section('content')
<div class="wrapper">
  <!--sidebar wrapper -->
@include('partials.sidebar')
<div class="page-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-xl-7 mx-auto">
      <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body p-5">
          <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">Nuevo Expediente</h5>
          </div>
          <hr>
          <form class="row g-3" action="{{route('travels.store')}}" method="post">
            @csrf
              <p class="mb-0 text-primary">Datos del Viaje</p>
            <div class="form-check-danger form-check form-switch">
							<input class="form-check-input" type="checkbox" name="travel_type" id="flexSwitchCheckCheckedDanger" onclick="hidedate()">
							<label class="form-check-label" for="flexSwitchCheckCheckedDanger">¿Solo ida?</label>
						</div>
            <div class="col-md-4">
              <label for="inputFirstName"  class="form-label">Localizador</label>
              <input type="text"  class="form-control" id="localizador" name="localizador" onclick="pastetext('localizador')"  required>
            </div>
            <div class="col-md-4">
							<label class="form-label">Fecha de Salida:</label>
							<input type="date" class="form-control" name="date_departure" required>
            </div>
            <div class="col-md-4"  id="date_arrival">
              <label class="form-label">Fecha de Regreso:</label>
							<input type="date" class="form-control" name="date_arrival">
            </div>

            <div class="col-lg-6 mt-4">
              <div class="mb-3">
                  <label class="form-label">Origen</label>
                  <div class="input-group">
                    <select class="form-select single-select" name="travel_from" required>
                      <option selected value="">Seleccionar Destino</option>
                      @forelse($destinations as $destinationsItem)
                      <option value="{{$destinationsItem->id_destination}}">{{$destinationsItem->name_destination}}</option>
                      @empty
                      @endforelse
                    </select>
                  </div>
                </div>
             </div>
             <div class="col-lg-6  mt-4">
               <div class="mb-3">
                   <label class="form-label">Destino</label>
                   <div class="input-group">
                     <select class="form-select single-select" name="travel_to" required>
                       <option selected value="">Seleccionar Destino</option>
                       @forelse($destinations as $destinationsItem)
                       <option value="{{$destinationsItem->id_destination}}">{{$destinationsItem->name_destination}}</option>
                       @empty
                       @endforelse
                     </select>
                   </div>
                 </div>
              </div>

            <div class="col-12">
              <label for="inputAddress" class="form-label">Observaciones</label>
              <textarea class="form-control" name="travel_details" id="" placeholder="Observaciones..." rows="3"></textarea>
            </div>

            <p class="mb-0 text-primary">Datos del Pasajero</p>
            <hr>
              <table id="myTable" class=" table order-list">
                <thead>
                    <tr>
                        <td>Servicio</td>
                        <td>Telefono</td>
                        <td>Neto</td>
                        <td>PVP</td>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="col-sm-5">
                        <input type="text" name="name1" class="form-control" id="name1" onclick="" required />
                    </td>
                    <td class="col-sm-3">
                        <input type="text" name="phone1"  class="form-control" id="phone1" onclick="" required/>
                    </td>
                    <td class="col-sm-2">
                      <input type="number" step="any" name="neto1"  class="form-control suma" id="neto1" onclick="" onchange="suma(this.value)" required/>
                    </td>
                    <td class="col-sm-2">
                          <input type="number" step="any" name="pvp1"  class="form-control suma" id="pvp1" onclick="" onchange="suma(this.value)" required/>
                    </td>
                    <td class="col-sm-2"><a class="deleteRow"></a>

                    </td>
                  </tr>
                </tbody>
                <tfoot>
                    <tr>
                      <td colspan="5" style="text-align: center;">
                        <input type="button" class="btn btn-success btn-block " id="addrow" value="Agregar Servicio" />
                      </td>
                    </tr>
                    <tr>
                    </tr>
                </tfoot>
            </table>
            <div class="col-6">
              Total: <span id="total"></span> <br>
              Servicios: <span id="pasajeros"></span>
            </div>
            <div class="col-6 text-end">
              <button type="submit" class="btn btn-primary px-5">Guardar</button>
            </div>
            <input type="hidden" name="counter" id="counter" value="">
          </form>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
  var counter = 1;


  $("#addrow").on("click", function () {

      counter++;

      var newRow = $("<tr>");
      var cols = "";

      cols += '<td><input type="text" class="form-control" name="name' + counter + '" id="name' + counter + '" onclick=""/></td>';
      cols += '<td><input type="text" class="form-control" name="phone' + counter + '" id="phone' + counter + '"onclick=""/></td>';
      cols += '<td><input type="number" step="any" class="form-control suma" onchange="suma(this.value)" name="neto' + counter + '" id="neto' + counter + '"onclick=""/></td>';
      cols += '<td><input type="number" step="any" class="form-control suma" onchange="suma(this.value)" name="pvp' + counter + '" id="pvp' + counter + '"onclick=""/></td>';
      cols += '<td><button type="button" class="ibtnDel btn btn-outline-danger"><i class="fadeIn animated bx bx-trash"></i></button></td>';
      newRow.append(cols);
      $("table.order-list").append(newRow);
      document.getElementById('counter').value = counter
  });



  $("table.order-list").on("click", ".ibtnDel", function (event) {
      $(this).closest("tr").remove();
      console.log (counter)
      counter -= 1
      document.getElementById('counter').value = counter

      if(counter == 1){

        document.getElementById('counter').value = 1;

        var sum1 = document.getElementById('pvp1').value;

        document.getElementById("total").innerHTML = sum1
        document.getElementById("pasajeros").innerHTML = "1"

      }

      if(counter == 2){
        var sum1 = document.getElementById('pvp1').value;
        var sum2 = document.getElementById('pvp2').value;
        var sumatoria = parseFloat(sum1)+parseFloat(sum2);

        document.getElementById("total").innerHTML = sumatoria;
        document.getElementById("pasajeros").innerHTML = "2";

      }

      if(counter == 3){
        var sum1 = document.getElementById('pvp1').value;
        var sum2 = document.getElementById('pvp2').value;
        var sum3 = document.getElementById('pvp3').value;
        var sumatoria = parseFloat(sum1)+parseFloat(sum2)+parseFloat(sum3);

        document.getElementById("total").innerHTML = sumatoria;
        document.getElementById("pasajeros").innerHTML = "3";

      }

      if(counter == 4){
        var sum1 = document.getElementById('pvp1').value;
        var sum2 = document.getElementById('pvp2').value;
        var sum3 = document.getElementById('pvp3').value;
        var sum4 = document.getElementById('pvp4').value;
        var sumatoria = parseFloat(sum1)+parseFloat(sum2)+parseFloat(sum3)+parseFloat(sum4);

        document.getElementById("total").innerHTML = sumatoria;
        document.getElementById("pasajeros").innerHTML = "4";

      }

      if(counter == 5){
        var sum1 = document.getElementById('pvp1').value;
        var sum2 = document.getElementById('pvp2').value;
        var sum3 = document.getElementById('pvp3').value;
        var sum4 = document.getElementById('pvp4').value;
        var sum5 = document.getElementById('pvp5').value;
        var sumatoria = parseFloat(sum1)+parseFloat(sum2)+parseFloat(sum3)+parseFloat(sum4)+parseFloat(sum5);

        document.getElementById("total").innerHTML = sumatoria;
        document.getElementById("pasajeros").innerHTML = "5";

      }


  });




// pego los valores onclick
async function pastetext(id){
    let text = '';

    try {
      text = await navigator.clipboard.readText();
    }
    catch (err) {
      // console.error('Could not read from clipboard', err);
    }

    if (text) {
      // console.log(text)
      document.getElementById(id).value = text;
    }
}

// sumo el total
function suma(){

  if(counter == 1){

    document.getElementById('counter').value = 1;

    var sum1 = document.getElementById('pvp1').value;

    document.getElementById("total").innerHTML = sum1
    document.getElementById("pasajeros").innerHTML = "1"

  }

  if(counter == 2){
    var sum1 = document.getElementById('pvp1').value;
    var sum2 = document.getElementById('pvp2').value;
    var sumatoria = parseFloat(sum1)+parseFloat(sum2);

    document.getElementById("total").innerHTML = sumatoria;
    document.getElementById("pasajeros").innerHTML = "2";

  }

  if(counter == 3){
    var sum1 = document.getElementById('pvp1').value;
    var sum2 = document.getElementById('pvp2').value;
    var sum3 = document.getElementById('pvp3').value;
    var sumatoria = parseFloat(sum1)+parseFloat(sum2)+parseFloat(sum3);

    document.getElementById("total").innerHTML = sumatoria;
    document.getElementById("pasajeros").innerHTML = "3";

  }

  if(counter == 4){
    var sum1 = document.getElementById('pvp1').value;
    var sum2 = document.getElementById('pvp2').value;
    var sum3 = document.getElementById('pvp3').value;
    var sum4 = document.getElementById('pvp4').value;
    var sumatoria = parseFloat(sum1)+parseFloat(sum2)+parseFloat(sum3)+parseFloat(sum4);

    document.getElementById("total").innerHTML = sumatoria;
    document.getElementById("pasajeros").innerHTML = "4";

  }

  if(counter == 5){
    var sum1 = document.getElementById('pvp1').value;
    var sum2 = document.getElementById('pvp2').value;
    var sum3 = document.getElementById('pvp3').value;
    var sum4 = document.getElementById('pvp4').value;
    var sum5 = document.getElementById('pvp5').value;
    var sumatoria = parseFloat(sum1)+parseFloat(sum2)+parseFloat(sum3)+parseFloat(sum4)+parseFloat(sum5);

    document.getElementById("total").innerHTML = sumatoria;
    document.getElementById("pasajeros").innerHTML = "5";

  }
  //

  // console.log(counter)
}


function hidedate() {
  $("#date_arrival").toggleClass("d-none");
}


</script>
@endsection
