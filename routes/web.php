<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Modulos\VehiculoController;
use App\Http\Controllers\Modulos\VehiculoDocumentoController;
use App\Http\Controllers\Modulos\HerramientaController;
use App\Http\Controllers\Modulos\ConductorController;
use App\Http\Controllers\Auth\AlertasController;
use App\Http\Controllers\Modulos\HistorialController;


Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        app(\App\Http\Controllers\Auth\AlertasController::class)->enviarAlertas();
        return app(\App\Http\Controllers\DashboardController::class)->index();
    })->name('dashboard');
    
    //-------------------------------------------------------------------------------------------------------------------------
    //Vehiculos
    Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('vehiculos.index');
    Route::get('/vehiculos/camionetas', [VehiculoController::class,'camionetas'])->name('vehiculos.camionetas');
    Route::get('/vehiculos/compactadores', [VehiculoController::class,'compactadores'])->name('vehiculos.compactadores');
    Route::get('/vehiculos/motos', [VehiculoController::class, 'motos'])->name('vehiculos.motos');
    Route::get('/vehiculos/otros', [VehiculoController::class,'otros'])->name('vehiculos.otros');
    
    // Actions that require Coordinador or Administrador
    Route::middleware(['coordinador.admin'])->group(function () {
        Route::get('/vehiculos/agregar', [VehiculoController::class, 'create'])->name('vehiculos.create');
        Route::post('/vehiculos', [VehiculoController::class, 'store'])->name('vehiculos.store');
        Route::get('/vehiculos/modificar/{vehiculo}', [VehiculoController::class, 'edit'])->name('vehiculos.edit');
        Route::put('/vehiculos/modificar/{vehiculo}', [VehiculoController::class, 'update'])->name('vehiculos.update');
        Route::get('/vehiculos/eliminar', [VehiculoController::class, 'eliminate'])->name('vehiculos.eliminate');
        Route::delete('/vehiculos/{id}', [VehiculoController::class, 'destroy'])->name('vehiculos.destroy');

        // Rutas para modificar y asignar vehículos (ya protegidas por coordinador.admin group above)
    });

    //-------------------------------------------------------------------------------------------------------------------------
    //Herramientas
    Route::get('/herramientas', [HerramientaController::class, 'index'])->name('herramientas.index');
    
    // Static routes first
    Route::get('/herramientas/mecanicas', [HerramientaController::class, 'mecanicas'])->name('herramientas.mecanicas');
    Route::get('/herramientas/electricas', [HerramientaController::class, 'electricas'])->name('herramientas.electricas');
    Route::get('/herramientas/medicion', [HerramientaController::class, 'medicion'])->name('herramientas.medicion');
    Route::get('/herramientas/otros', [HerramientaController::class, 'otros'])->name('herramientas.otros');
    // Actions that require Coordinador or Administrador
    Route::middleware(['coordinador.admin'])->group(function () {
        Route::get('/herramientas/agregar', [HerramientaController::class, 'create'])->name('herramientas.create');
        Route::get('/herramientas/eliminar', [HerramientaController::class, 'eliminate'])->name('herramientas.eliminate');
        Route::get('/herramientas/asignar', [HerramientaController::class, 'asignarForm'])->name('herramientas.asignar.form');

        // POST/PUT/DELETE routes
        Route::post('/herramientas', [HerramientaController::class, 'store'])->name('herramientas.store');
        Route::post('/herramientas/asignar', [HerramientaController::class, 'asignar'])->name('herramientas.asignar');
        Route::post('/herramientas/{herramienta}/devolver', [HerramientaController::class, 'devolver'])->name('herramientas.devolver');
        Route::put('/herramientas/modificar/{herramienta}', [HerramientaController::class, 'update'])->name('herramientas.update');
        Route::delete('/herramientas/{herramienta}', [HerramientaController::class, 'destroy'])->name('herramientas.destroy');
    });
    
    // GET parameterized routes last
    Route::get('/herramientas/asignar/{herramienta}', [HerramientaController::class, 'asignarForm'])->name('herramientas.asignar.form.id');
    Route::get('/herramientas/modificar/{herramienta}', [HerramientaController::class, 'edit'])->name('herramientas.edit');
    
    Route::patch('/vehiculos/{vehiculo}/estado', [VehiculoController::class, 'cambiarEstado'])->name('vehiculos.cambiarEstado');

    Route::middleware(['coordinador.admin'])->group(function () {
        Route::post('/vehiculos/documentos/subir/{detalle}', [VehiculoDocumentoController::class, 'subir'])->name('vehiculos.documentos.subir');
        Route::get('/vehiculos/documentos/descargar/{documento}', [VehiculoDocumentoController::class, 'descargar'])->name('vehiculos.documentos.descargar');
        Route::get('/vehiculos/documentos/historial/{detalle}', [VehiculoDocumentoController::class, 'historial'])->name('vehiculos.documentos.historial');
        Route::get('/vehiculos/documentos/ver/{documento}', [VehiculoDocumentoController::class, 'ver'])->name('vehiculos.documentos.ver');
        Route::delete('/vehiculos/documentos/{documento}/eliminar', [VehiculoDocumentoController::class, 'eliminar'])->name('vehiculos.documentos.eliminar');
    });

    //-------------------------------------------------------------------------------------------------------------------------
    // Conductores - protect management actions
    Route::get('/conductores', [ConductorController::class, 'index'])->name('conductores.index');

    Route::middleware(['coordinador.admin'])->group(function () {
        //Actions
        Route::get('/conductores/agregar', [ConductorController::class, 'create'])->name('conductores.create');
        Route::post('/conductores', [ConductorController::class, 'store'])->name('conductores.store');
        Route::get('/conductores/eliminar', [ConductorController::class, 'eliminate'])->name('conductores.eliminar');
        Route::delete('/conductores/{conductor}', [ConductorController::class, 'destroy'])->name('conductores.destroy');
        Route::get('/conductores/modificar/{conductor}', [ConductorController::class, 'edit'])->name('conductores.edit');
        Route::put('/conductores/modificar/{conductor}', [ConductorController::class, 'update'])->name('conductores.update');

        // Rutas para asignación de conductores
        Route::get('/conductores/asignar', [ConductorController::class, 'asignarForm'])->name('conductores.asignar.form');
        Route::post('/conductores/asignar', [ConductorController::class, 'asignar'])->name('conductores.asignar');
    });
    
    //-------------------------------------------------------------------------------------------------------------------------
    //Alertas
    Route::get('/alertas', [AlertasController::class, 'index'])->name('alertas.index');
    
    //-------------------------------------------------------------------------------------------------------------------------
    // Historial - restrict access to Coordinador or Administrador
    Route::middleware(['coordinador.admin'])->group(function () {
        Route::get('/historial', [\App\Http\Controllers\Modulos\HistorialController::class, 'index'])->name('historial.index');
        Route::get('/historial/eliminar/{item}', function($item) {
            // Puedes pasar el item al view según tu lógica
            return view('modulos.historial.eliminar', compact('item'));
        })->name('historial.eliminar');
        Route::delete('/historial/eliminar/{item}', [HistorialController::class, 'destroy'])->name('historial.destroy');
        Route::get('/historial/mantenimientos/{item}', [HistorialController::class, 'mantenimientos'])->name('historial.mantenimientos');
        Route::get('/historial/editar/{item}', [HistorialController::class, 'editar'])->name('historial.editar');
        Route::get('/historial/herramienta/{id}', [HistorialController::class, 'historialHerramienta'])->name('historial.herramienta');
        Route::get('/historial/vehiculo/{id}', [HistorialController::class, 'historialVehiculo'])->name('historial.vehiculo');
    });

    // Chatbot routes removed
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::post('/auth', [AuthController::class, 'handle'])->name('auth.handle');

Route::get('/password/reset', function () {
    return view('auth.verycontra');
})->name('password.request');

Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');