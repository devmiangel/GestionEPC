<aside class="sidebar">
    <form class="sidebar__form">
        <input type="checkbox" id="open-menu">
        <label class="material-symbols-outlined" for="open-menu">close</label>
    </form>
    <nav class="sidebar__nav">
        <ul>
            <li class = "sidebar__item">
                <span class="material-symbols-outlined">home</span>
                <a href="" class="">Home</a>
            </li>
            <li class = "sidebar__item">
                <span class="material-symbols-outlined">directions_car</span>
                <a href="">Vehiculos</a>
                <ul>
                    <li class = "sidebar__item">
                        <span class="material-symbols-outlined">directions_bus</span>
                        <a href="">Camiones</a>
                    </li>
                    <li class = "sidebar__item">
                        <span class="material-symbols-outlined">car_gear</span>
                        <a href="">camionetas</a>
                    </li>
                    <li class = "sidebar__item">
                        <span class="material-symbols-outlined">directions_bike</span>
                        <a href="">motos</a>
                    </li>
                </ul>
            </li>
             <li class = "sidebar__item">
                <span class="material-symbols-outlined">handyman</span>
                <a href="">Herramientas</a>
                <ul>
                    <li class = "sidebar__item">
                        <span class="material-symbols-outlined">car_gear</span>
                        <a href="">herramienta 1</a>
                    </li>
                    <li class = "sidebar__item">
                        <span class="material-symbols-outlined">car_gear</span>
                        <a href="">herramienta 2</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>

<style>
.sidebar{
    --bg-color: color-mix(in srgb, #f5f6fa 80%, #2e2e2e 20%);
    --sidebar-color: #2c3e50;
    --text-color: #f5f6fa;

    position: fixed;
    background-color: var(--sidebar-color);
    height: 100dvh;
    width: calc(220px, 20vw, 300 px);
    font-size: 1.1rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 30px 0 30px 6px;
}

.sidebar__nav{
  flex: 1;
  display: flex;
}

.sidebar__nav ul{
  flex-direction:column ;
  display: flex;
  justify-content: center;
}

.sidebar__item{
  list-style: none;
  display: flex;
  align-items: center;
  font-size: .9rem;
  padding-right: 6px;
}

.sidebar__item span{
  padding: 12px;
  font-size: 2rem;
}

.sidebar__form{
  position: absolute;
  display: none;
}
</style>