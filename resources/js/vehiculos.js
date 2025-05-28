document.addEventListener("DOMContentLoaded", () => {
    const backButton = document.getElementById("backButton");

    if (backButton) {
        backButton.addEventListener("click", showAll);
    }
});

function expandirTarjetaModal(tarjeta) {
    const imgSrc = tarjeta.parentElement.querySelector('img')?.src || '';
    const detalles = tarjeta.querySelector('.detalle').innerHTML;

    document.getElementById('modalImagen').src = imgSrc;
    document.getElementById('modalDetalles').innerHTML = detalles;
    document.getElementById('modalVehiculo').style.display = 'flex';
}

function cerrarModal() {
    document.getElementById('modalVehiculo').style.display = 'none';
}

function showDetails(item) {
    const vehicles = document.querySelectorAll(".Item");
    vehicles.forEach(vehicle => {
        vehicle.style.display = "none";
    });

    item.style.display = "flex";
    document.getElementById("backButton").classList.remove("hidden");
}

function showAll() {
    document.querySelectorAll(".Item").forEach(vehicle => {
        vehicle.style.display = "flex";
    });

    document.getElementById("backButton").classList.add("hidden");
}
