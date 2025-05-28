<div class="sidebar" id="sidebar"> 
    <div class="menu-btn" id="menu-btn">
        <i class='bx bx-left-arrow-alt'></i>
    </div>
    <div class="brand">
        <br><br><br>
    </div>
    <div class="menu-container">
        <div class="search">
            <i class='bx bx-search'></i>
            <input type="search" placeholder="search">
        </div>
    </div>
    <ul class="menu">
        <li class="menu-item menu-item-static">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class='bx bx-home'></i>
                <span>Home</span>
            </a>
        </li>
        <li class="menu-item menu-item-dropdown">
            <a href="{{ route('vehiculos.index') }}" class="menu-link">
                <i class='bx bxs-car'></i>
                <span>Vehículos</span>
                <i class='bx bxs-down-arrow'></i>
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('vehiculos.compactadores') }}" class="sub-menu-link"><i class='bx bxs-truck'></i> Compactadores</a></li>
                <li><a href="{{ route('vehiculos.camiones') }}" class="sub-menu-link"><i class='bx bxs-car bx-flip-horizontal'></i> Camiones</a></li>
                <li><a href="{{ route('vehiculos.motos') }}" class="sub-menu-link"><i class="material-symbols-outlined">two_wheeler</i> Motos</a></li>
                <li><a href="{{ route('vehiculos.otros') }}" class="sub-menu-link"><i class='bx bx-car'></i> Otros</a></li>
            </ul>
        </li>
        <li class="menu-item menu-item-dropdown">
            <a href="{{ route('herramientas.index') }}" class="menu-link">
                <i class='bx bx-wrench'></i>
                <span>Herramientas</span>
                <i class='bx bxs-down-arrow'></i>
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('herramientas.create') }}" class="sub-menu-link"><i class='bx bx-plus'></i> Agregar</a></li>
                <li><a href="{{ route('herramientas.eliminate') }}" class="sub-menu-link"><i class='bx bx-trash'></i> Eliminar</a></li>
                <li><a href="{{ route('herramientas.asignar.form') }}" class="sub-menu-link"><i class='bx bx-user-plus'></i> Asignar</a></li>
            </ul>
        </li>
    </ul>
</div>