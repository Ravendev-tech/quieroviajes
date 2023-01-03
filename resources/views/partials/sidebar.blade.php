<div class="sidebar-wrapper  no-print" data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <img src="{{url('/')}}/assets/images/logodelyar.png"  class="logo-icon" alt="logo icon">
    </div>
    <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
    </div>
  </div>
  <!--navigation for costumer-->
  @if((Auth::user()->user_level) == 3)
  <ul class="metismenu" id="menu">
    <li>
      <a href="{{route('homecostumer')}}" class="">
        <div class="parent-icon"><i class='bx bx-home-circle'></i>
        </div>
        <div class="menu-title">Escritorio</div>
      </a>
    </li>
    <li>
      <a href="{{route('travels.index')}}" class="">
        <div class="parent-icon"><i class="lni lni-folder"></i>
        </div>
        <div class="menu-title">Expedientes</div>
      </a>
    <li>
      <a href="{{route('destination.index')}}" class="">
        <div class="parent-icon"><i class="lni lni-travel"></i>
        </div>
        <div class="menu-title">Destinos</div>
      </a>
    </li>
    <li>
      <a href="{{route('logout')}}" class="">
        <div class="parent-icon"><i class="fadeIn animated bx bx-log-out"></i>
        </div>
        <div class="menu-title">Salir</div>
      </a>
    </li>

  </ul>
  @else
  @endif


  <!-- menu for admin -->
  @if((Auth::user()->user_level) == 1)
  <ul class="metismenu" id="menu">
    <li>
      <a href="{{route('homeadmin')}}" class="">
        <div class="parent-icon"><i class='bx bx-home-circle'></i>
        </div>
        <div class="menu-title">Escritorio</div>
      </a>
    </li>
    <li>
      <a href="{{route('clients.index')}}" class="">
        <div class="parent-icon"><i class="lni lni-user"></i>
        </div>
        <div class="menu-title">Usuarios</div>
      </a>
    </li>
    <li>
      <a href="{{route('travels.index')}}" class="">
        <div class="parent-icon"><i class="lni lni-folder"></i>
        </div>
        <div class="menu-title">Expedientes</div>
      </a>
    </li>
    <li>
        <a href="{{route('daily',date('Y-m-d'))}}" class="">
        <div class="parent-icon"><i class="fadeIn animated bx bx-bar-chart"></i>
        </div>
        <div class="menu-title">Reporte Diario</div>
      </a>
    </li>
    <li>
        <a href="{{route('agents')}}" class="">
        <div class="parent-icon"><i class="fadeIn animated bx bx-bar-chart"></i>
        </div>
        <div class="menu-title">Reporte de Agentes</div>
      </a>
    </li>
    <!-- <li>
      <a href="#" class="">
        <div class="parent-icon"><i class="lni lni-ticket-alt"></i>
        </div>
        <div class="menu-title">Recibos</div>
      </a>
    </li> -->
    <li>
      <a href="{{route('destination.index')}}" class="">
        <div class="parent-icon"><i class="lni lni-travel"></i>
        </div>
        <div class="menu-title">Destinos</div>
      </a>
    </li>
    <li>
      <a href="{{route('logout')}}" class="">
        <div class="parent-icon"><i class="fadeIn animated bx bx-log-out"></i>
        </div>
        <div class="menu-title">Salir</div>
      </a>
    </li>

  </ul>
  @else
  @endif
  <!--end navigation-->
</div>
