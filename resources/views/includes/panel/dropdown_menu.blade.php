<div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">¡Bienvenido!</h6>
            </div>
            <!-- FIXME: Vamos a implementar el perfil-->
            <a href="#" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>Mi perfil</span>
            </a>
            <!-- FIXME: Vamos a implmentar las configuraciones-->
            <a href="#" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Configuraciones</span>
            </a>
            <!-- FIXME: Vamos a implementar mis citas-->
            <a href="#" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Mis citas</span>
            </a>
            <a href="#" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Ayuda</span>
            </a>
            <div class="dropdown-divider"></div>
            <!-- Cuando hagamos clic se va activar un evento para que no se actualice la pagina y accedemos al elemento que tenga un ID determinado para finalmente hacer submit de dicho elemento -->
            <a href=" {{ route('logout') }} " class="dropdown-item" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
                <i class="ni ni-user-run"></i>
                <span>Cerrar sesión</span>
            </a>
            <!-- Para cerrar sesión debemos de hacer una petición tipo POST -->
            <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
                <!-- Como es una peticion de tipo POST tenemos que incluir un token @csrf -->
                @csrf
            </form>
        </div>