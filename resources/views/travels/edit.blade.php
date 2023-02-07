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
            <h5 class="mb-0 text-primary">Editar Expediente</h5>
          </div>
          <hr>
          <form class="row g-3" action="{{route('travels.store2')}}" method="post">
            @csrf
              <p class="mb-0 text-primary">Datos del Viaje</p>
            <!-- <div class="form-check-danger form-check form-switch">
							<input class="form-check-input" type="checkbox" name="travel_type" id="flexSwitchCheckCheckedDanger">
							<label class="form-check-label" for="flexSwitchCheckCheckedDanger">¿Solo ida?</label>
						</div> -->
            <div class="col-md-4">
              <label for="inputFirstName"  class="form-label">Localizador</label>
              <input type="text"  class="form-control" id="localizador" <?php if( (Auth::user()->user_level) == 3 ){echo "readonly='readonly'";} ?> name="localizador" value="{{$expediente[0]->localizador}}"  required>
              <input type="hidden" value="{{$expediente[0]->localizador}}" name="localizadorupdate">
            </div>
            <div class="col-md-4">
							<label class="form-label">Fecha de Salida:</label>
							<input type="date" class="form-control" value="{{$expediente[0]->date_departure}}" name="date_departure" required>
            </div>

            <div class="col-md-4">
              @if(!empty($expediente[0]->date_arrival))
              <label class="form-label">Fecha de Regreso:</label>
              <input type="date" class="form-control" name="date_arrival" value="{{$expediente[0]->date_arrival}}">
              @else
              @endif
            </div>

            <div class="col-lg-4 mt-4">
              <div class="mb-3">
                  <label class="form-label">Origen</label>
                  <div class="input-group">
                    <select class="form-select single-select" name="travel_from" required>
                      <option selected value="{{$expediente[0]->travel_from}}">{{$expediente[0]->destfrom}} </option>
                      @forelse($destinations as $destinationsItem)
                      <option value="{{$destinationsItem->id_destination}}">{{$destinationsItem->name_destination}}</option>
                      @empty
                      @endforelse
                    </select>
                  </div>
                </div>
             </div>
             <div class="col-lg-4  mt-4">
               <div class="mb-3">
                   <label class="form-label">Destino</label>
                   <div class="input-group">
                     <select class="form-select single-select" name="travel_to" required>
                       <option selected value="{{$expediente[0]->travel_to}}">{{$expediente[0]->destto}}</option>
                       @forelse($destinations as $destinationsItem)
                       <option value="{{$destinationsItem->id_destination}}">{{$destinationsItem->name_destination}}</option>
                       @empty
                       @endforelse
                     </select>
                   </div>
                 </div>
              </div>
              <div class="col-md-4 mt-4">
                <label for="inputFirstName"  class="form-label">Costo de cancelación</label>
                <input type="number"  class="form-control" id="cancelacion" name="travel_cancelacion" value="{{$expediente[0]->travel_cancelacion}}"  required>
              </div>

            <div class="col-12">
              <label for="inputAddress" class="form-label">Observaciones</label>
              <textarea class="form-control" name="travel_details" id="" placeholder="Observaciones..." rows="3">{{$expediente[0]->travel_details}}</textarea>
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
                  <?php $i = 1 ?>
                  @forelse($expediente as $expedienteItem)
                  <tr>
                    <td class="col-sm-5">
                        <input type="text" name="" class="form-control" id="name{{$i}}"  value="{{$expedienteItem->client_fullname}}" required />
                    </td>
                    <td class="col-sm-3">
                        <input type="text" name=""  class="form-control" id="phone{{$i}}"  value="{{$expedienteItem->client_phone}}" />
                    </td>
                    <td class="col-sm-2">
                        <input type="number" step="any" name=""  class="form-control suma" id="neto{{$i}}" onchange="suma(this.value)" value="{{$expedienteItem->travel_neto}}" required/>
                    </td>
                    <td class="col-sm-2">
                        <input type="number" step="any" name=""  class="form-control suma" id="pvp{{$i}}"  onchange="suma(this.value)" value="{{$expedienteItem->travel_pvp}}" required/>
                    </td>
                    <td class="col-sm-2"><a class="deleteRow"></a>

                    </td>
                  </tr>
                  <?php $i++ ?>
                  @empty
                  @endforelse
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
              Total: <span id="total">{{$amount}}€</span> <br>
              Servicios: <span id="pasajeros">{{$passangers}}</span>
            </div>
            <div class="col-6 text-end">
              <button type="submit" class="btn btn-primary px-5">Guardar</button>
            </div>
            <input type="hidden" name="counter" id="counter" value="">
            <input type="hidden" name="counter2" id="counter2" value="">
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
  var counter = <?php echo $passangers; ?> ;
  var counter2 = 0;
 console.log(counter);

  $("#addrow").on("click", function () {

      counter++;
      counter2++;

      var newRow = $("<tr>");
      var cols = "";

      cols += '<td><input type="text" class="form-control" name="name' + counter2 + '" id="name' + counter + '" onclick=""/></td>';
      cols += '<td><input type="text" class="form-control" name="phone' + counter2 + '" id="phone' + counter + '"onclick=""/></td>';
      cols += '<td><input type="number" step="any" class="form-control suma" onchange="suma(this.value)" name="neto' + counter2 + '" id="neto' + counter + '"onclick="suma(this.value)"/></td>';
      cols += '<td><input type="number" step="any" class="form-control suma" onchange="suma(this.value)" name="pvp' + counter2 + '" id="pvp' + counter + '"onclick="suma(this.value)"/></td>';
      cols += '<td><button type="button" class="ibtnDel btn btn-outline-danger"><i class="fadeIn animated bx bx-trash"></i></button></td>';
      newRow.append(cols);
      $("table.order-list").append(newRow);
      document.getElementById('counter').value = counter;
      document.getElementById('counter2').value = counter2;
  });



  $("table.order-list").on("click", ".ibtnDel", function (event) {
      $(this).closest("tr").remove();
      console.log (counter)
      counter -= 1
      counter2 -= 1
      document.getElementById('counter').value = counter
      document.getElementById('counter2').value = counter2;

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

</script>
@endsection
