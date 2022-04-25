{{-- Heading --}}
<h6 class="navbar-heading text-muted">
    {{-- ! Si el rol es admin verá el siguiente mensaje --}}
    @if(auth()->user()->role == 'admin')
    Gestionar datos
    @else
    Menú
    @endif

</h6>
{{-- Navigation (menu lateral izquierdo --}}
<ul class="navbar-nav">
    {{-- ! Vamos hacer condiciones para ver las vistas. Si eres admin podrás ver las siguientes vistas --}}
    @if(auth()->user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link" href="/home">
                <i class="ni ni-tv-2 text-red"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/specialties') }}">
                <i class="ni ni-planet text-blue"></i> Especialidades
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/doctors') }}">
                <i class="ni ni-single-02 text-orange"></i> Médicos
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/patients') }}">
                <i class="ni ni-satisfied text-info"></i> Pacientes
            </a>
        </li>
    {{-- ! En cambio, si eres doctor verás la siguientes vistas --}}
    @elseif (auth()->user()->role == 'doctor')
        <li class="nav-item">
            <a class="nav-link" href="/home">
                <i class="ni ni-calendar-grid-58 text-red"></i> Gestionar horario
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/specialties') }}">
                <i class="ni ni-time-alarm text-primary"></i> Mis citas
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/patients') }}">
                <i class="ni ni-satisfied text-info"></i> Mis pacientes
            </a>
        </li>
    {{-- ! Vistas para el paciente --}}
    @else
        <li class="nav-item">
            <a class="nav-link" href="/home">
                <i class="ni ni-send text-red"></i> Reservar cita
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/specialties') }}">
                <i class="ni ni-time-alarm text-primary"></i> Mis citas
            </a>
        </li>

    @endif
    <li class="nav-item">
        {{-- Cuando hagamos clic se va activar un evento para que no se actualice la pagina y accedemos al elemento que tenga un ID determinado para finalmente hacer submit de dicho elemento --}}
        <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
            <i class="ni ni-key-25"></i> Cerrar sesión
        </a>
        {{-- Para cerrar sesión debemos de hacer una petición tipo POST --}}
        <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
            {{-- Como es una peticion de tipo POST tenemos que incluir un token @csrf --}}
            @csrf
        </form>
    </li>
</ul>
{{-- ! Vamos hacer condiciones para ver las vistas. Si eres admin podrás ver las siguientes vistas --}}
@if(auth()->user()->role == 'admin')
{{-- Divider --}}
<hr class="my-3">
{{-- Heading --}}
<h6 class="navbar-heading text-muted">Reportes</h6>
{{-- Navigation --}}
<ul class="navbar-nav mb-md-3">
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-sound-wave text-yellow"></i> Frecuencia de citas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-spaceship text-red"></i> Médicos más activos
        </a>
    </li>
</ul>
@endif