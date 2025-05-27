<div class="sidebar" id="sidebar"> 
    <div class="menu-btn" id="menu-btn">
        <i class='bx bx-left-arrow-alt'></i>
    </div>
    <div class="brand">
        <img src="{{ asset('img/logo_epc.webp') }}" alt="logo_epc">
    </div>
    <div class="menu-container">
        <div class="search">
            <i class='bx bx-search'></i>
            <input type="search" placeholder="search">
        </div>
    </div>
    <ul class="menu">
        <li class="menu-item menu-item-static">
            <a href="#" class="menu-link">
                <i class='bx bx-home'></i>
                <span>Home</span>
            </a>
        </li>
        <li class="menu-item menu-item-dropdown">
            <a href="#" class="menu-link">
                <i class='bx bxs-car'></i>
                <span>Vehículos</span>
                <i class='bx bxs-down-arrow'></i>
            </a>
            <ul class="sub-menu">
                <li><a href="#camiones" class="sub-menu-link"><i class='bx bxs-truck'></i> Camiones</a></li>
                <li><a href="#camionetas" class="sub-menu-link"><i class='bx bxs-car bx-flip-horizontal'></i> Camionetas</a></li>
                <li><a href="#Motos" class="sub-menu-link"><i class="material-symbols-outlined">two_wheeler</i> Motos</a></li>
            </ul>
        </li>
        <li class="menu-item menu-item-dropdown">
            <a href="#" class="menu-link">
                <i class='bx bx-wrench'></i>
                <span>Herramientas</span>
                <i class='bx bxs-down-arrow'></i>
            </a>
            <ul class="sub-menu">
                <li><a href="#" class="sub-menu-link">Herramienta1</a></li>
                <li><a href="#" class="sub-menu-link">Herramienta2</a></li>
                <li><a href="#" class="sub-menu-link">Herramienta3</a></li>
            </ul>
        </li>
    </ul>
</div>
