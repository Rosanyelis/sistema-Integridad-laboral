<div class="nav-align-top">
      <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-md-0 gap-2">
        <li class="nav-item ">
          <a class="nav-link @if(request()->routeIs('people.show')) active @endif" href="{{ route('people.show', $person->id) }}">
            <i class="icon-base ti tabler-users icon-sm me-1_5"></i> 
            INF. PERSONAL
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if(request()->routeIs('people.showInformationResidential')) active @endif" href="{{ route('people.showInformationResidential', $person->id) }}">
            <i class="icon-base ti tabler-lock icon-sm me-1_5"></i> 
            INF. RESIDENCIAL
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">
            <i class="icon-base ti tabler-bookmark icon-sm me-1_5"></i> 
            REF. PERSONALES
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">
            <i class="icon-base ti tabler-bell icon-sm me-1_5"></i> 
            HAB. EDUCATIVAS
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">
            <i class="icon-base ti tabler-bell icon-sm me-1_5"></i> 
            EXP. LABORAL
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">
            <i class="icon-base ti tabler-link icon-sm me-1_5"></i> 
            ASPIRACIONES
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">
            <i class="icon-base ti tabler-link icon-sm me-1_5"></i> 
            DISPONIBILIDAD
          </a>
        </li>
      </ul>
    </div>