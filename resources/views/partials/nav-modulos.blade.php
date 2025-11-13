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
        @php
            $hasDashboard = \Illuminate\Support\Facades\Route::has('dashboard');
        @endphp
        <!-- Estadísticas menu item removed to avoid duplicates; use Dashboard page's stats toggle -->
        <li class="menu-item menu-item-static">
            <a href="{{ route('vehiculos.index') }}" class="menu-link">
                <i class='bx bxs-car'></i>
                <span>Vehículos</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('herramientas.index') }}" class="menu-link">
                <i class='bx bx-wrench'></i>
                <span>Herramientas</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('conductores.index') }}" class="menu-link">
                <i class='bx bx-id-card'></i>
                <span>Conductores</span>
            </a>
        </li>
    </ul>
</div>