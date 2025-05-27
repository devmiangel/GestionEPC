document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('DOMContentLoaded', function() {
    // Obtener parámetro de URL para preseleccionar tipo
    const urlParams = new URLSearchParams(window.location.search);
    const tipoPreseleccionado = urlParams.get('tipo');
    
    if (tipoPreseleccionado) {
        document.getElementById('tipoVehiculo').value = tipoPreseleccionado;
    }

    // Resto del código existente...
});

    const formAgregarVehiculo = document.getElementById('formAgregarVehiculo');
    
    formAgregarVehiculo.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Obtener los valores del formulario
        const tipoVehiculo = document.getElementById('tipoVehiculo').value;
        const placa = document.getElementById('placa').value;
        const modelo = document.getElementById('modelo').value;
        const anio = document.getElementById('anio').value;
        const color = document.getElementById('color').value;
        const observaciones = document.getElementById('observaciones').value;
        const imagen = document.getElementById('imagen').files[0];
        
        // Validaciones básicas
        if (!tipoVehiculo || !placa || !modelo || !anio || !color) {
            alert('Por favor complete todos los campos obligatorios');
            return;
        }
        
        // Crear objeto con los datos del vehículo
        const nuevoVehiculo = {
            tipo: tipoVehiculo,
            placa: placa,
            modelo: modelo,
            anio: anio,
            color: color,
            observaciones: observaciones,
            imagen: imagen ? URL.createObjectURL(imagen) : null
        };
        
        // Aquí normalmente harías una petición AJAX para guardar en el servidor
        console.log('Nuevo vehículo:', nuevoVehiculo);
        
        // Simulamos el guardado exitoso
        alert('Vehículo agregado correctamente');
        formAgregarVehiculo.reset();
        
        // Redirigir a la página de vehículos después de 1 segundo
        setTimeout(() => {
            window.location.href = 'vehiculos.html';
        }, 1000);
    });
    
    // Validación de placa en formato ABC-123
    document.getElementById('placa').addEventListener('input', function(e) {
        const placa = e.target.value;
        const regex = /^[A-Z]{3}-\d{3}$/;
        
        if (placa && !regex.test(placa)) {
            e.target.setCustomValidity('Formato de placa inválido. Use formato ABC-123');
        } else {
            e.target.setCustomValidity('');
        }
    });
});

function cerrarModal() {
    document.getElementById('modalVehiculo').style.display = 'none';
}

// Función para confirmar eliminación
function confirmarEliminacion(placa, tipo) {
    const modal = document.createElement('div');
    modal.id = 'confirmModal';
    modal.innerHTML = `
        <div class="modal-content-confirm">
            <h3>Confirmar Eliminación</h3>
            <p>¿Estás seguro que deseas eliminar el vehículo ${placa}?</p>
            <div class="modal-actions-confirm">
                <button class="btn-cancel" onclick="cerrarModal()">Cancelar</button>
                <button class="btn-confirm" onclick="eliminarVehiculo('${placa}', '${tipo}')">Eliminar</button>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
    modal.style.display = 'flex';
}

function cerrarModal() {
    const modal = document.getElementById('confirmModal');
    if (modal) {
        modal.style.display = 'none';
        setTimeout(() => modal.remove(), 300);
    }
}

function eliminarVehiculo(placa, tipo) {
    // Aquí iría la lógica para eliminar el vehículo
    console.log(`Eliminando vehículo ${placa} de tipo ${tipo}`);
    
    // Simular eliminación (en un caso real sería una petición AJAX)
    alert(`Vehículo ${placa} eliminado correctamente`);
    cerrarModal();
    
    // Recargar la lista de vehículos (o eliminar el elemento del DOM)
    // location.reload(); // Opción 1: Recargar página
    // Opción 2: Eliminar el elemento visualmente sin recargar
}