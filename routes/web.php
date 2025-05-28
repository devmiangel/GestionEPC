<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Modulos\VehiculoController;
use App\Http\Controllers\Modulos\HerramientaController;
use App\Http\Controllers\Modulos\ConductorController;
use App\Http\Controllers\Auth\AlertasController;


Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        app(\App\Http\Controllers\Auth\AlertasController::class)->enviarAlertas();
        return app(\App\Http\Controllers\DashboardController::class)->index();
    })->name('dashboard');
    
    Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('vehiculos.index');
    Route::get('/vehiculos/agregar', [VehiculoController::class, 'create'])->name('vehiculos.create');
    Route::post('/vehiculos', [VehiculoController::class, 'store'])->name('vehiculos.store');
    Route::get('/vehiculos/eliminar', [VehiculoController::class, 'eliminate'])->name('vehiculos.eliminate');
    Route::get('/vehiculos/camiones', [VehiculoController::class,'camiones'])->name('vehiculos.camiones');
    Route::get('/vehiculos/compactadores', [VehiculoController::class,'compactadores'])->name('vehiculos.compactadores');
    Route::get('/vehiculos/motos', [VehiculoController::class, 'motos'])->name('vehiculos.motos');
    Route::get('/vehiculos/otros', [VehiculoController::class,'otros'])->name('vehiculos.otros');
    Route::get('/herramientas', [HerramientaController::class, 'index'])->name('herramientas.index');
    Route::get('/herramientas/agregar', [HerramientaController::class, 'create'])->name('herramientas.create');
    Route::post('/herramientas', [HerramientaController::class, 'store'])->name('herramientas.store');
    Route::get('/herramientas/eliminar', [HerramientaController::class, 'eliminate'])->name('herramientas.eliminate');
    Route::delete('/herramientas/{herramienta}', [HerramientaController::class, 'destroy'])->name('herramientas.destroy');
    Route::get('/herramientas/mecanicas', [HerramientaController::class, 'mecanicas'])->name('herramientas.mecanicas');
    Route::get('/herramientas/electricas', [HerramientaController::class, 'electricas'])->name('herramientas.electricas');
    Route::get('/herramientas/medicion', [HerramientaController::class, 'medicion'])->name('herramientas.medicion');
    Route::get('/herramientas/otros', [HerramientaController::class, 'otros'])->name('herramientas.otros');
    
    Route::get('/conductores', [ConductorController::class, 'index'])->name('conductores.index');
    Route::get('/conductores/agregar', [ConductorController::class, 'create'])->name('conductores.create');
    Route::post('/conductores', [ConductorController::class, 'store'])->name('conductores.store');
    Route::get('/conductores/eliminar', [ConductorController::class, 'eliminate'])->name('conductores.eliminate');
    Route::delete('/conductores/{conductor}', [ConductorController::class, 'destroy'])->name('conductores.destroy');
    Route::get('/conductores/modificar/{conductor}', [ConductorController::class, 'edit'])->name('conductores.edit');
    Route::put('/conductores/modificar/{conductor}', [ConductorController::class, 'update'])->name('conductores.update');
    
    // Rutas para asignación de conductores
    Route::get('/conductores/asignar', [ConductorController::class, 'asignarForm'])->name('conductores.asignar.form');
    Route::post('/conductores/asignar', [ConductorController::class, 'asignar'])->name('conductores.asignar');
    
    // Rutas de alertas
    Route::get('/alertas', [AlertasController::class, 'index'])->name('alertas.index');
    
    // Si quieres exponer el envío manual de alertas (opcional):
    // Route::post('/alertas/enviar', [AlertasController::class, 'enviarAlertas'])->name('alertas.enviar');
    
    Route::get('/historial', [\App\Http\Controllers\Modulos\HistorialController::class, 'index'])->name('historial.index');
    Route::get('/historial/eliminar/{item}', function($item) {
        // Puedes pasar el item al view según tu lógica
        return view('modulos.historial.eliminar', compact('item'));
    })->name('historial.eliminar');
    Route::delete('/historial/{item}', [\App\Http\Controllers\Modulos\HistorialController::class, 'destroy'])->name('historial.destroy');
    Route::get('/historial/mantenimientos/{item}', [\App\Http\Controllers\Modulos\HistorialController::class, 'mantenimientos'])->name('historial.mantenimientos');
    Route::get('/historial/editar/{item}', [\App\Http\Controllers\Modulos\HistorialController::class, 'editar'])->name('historial.editar');
    
    // Rutas para modificar y asignar herramientas
    Route::get('/herramientas/modificar/{herramienta}', [HerramientaController::class, 'edit'])->name('herramientas.edit');
    Route::put('/herramientas/modificar/{herramienta}', [HerramientaController::class, 'update'])->name('herramientas.update');
    Route::get('/herramientas/asignar', [HerramientaController::class, 'asignarForm'])->name('herramientas.asignar.form');
    Route::post('/herramientas/asignar', [HerramientaController::class, 'asignar'])->name('herramientas.asignar');
    
    // Rutas para modificar y asignar vehículos
    Route::get('/vehiculos/modificar/{vehiculo}', [VehiculoController::class, 'edit'])->name('vehiculos.edit');
    Route::put('/vehiculos/modificar/{vehiculo}', [VehiculoController::class, 'update'])->name('vehiculos.update');
    Route::get('/vehiculos/asignar', [VehiculoController::class, 'asignarForm'])->name('vehiculos.asignar.form');
    Route::post('/vehiculos/asignar', [VehiculoController::class, 'asignar'])->name('vehiculos.asignar');
    Route::delete('/vehiculos/{id}', [VehiculoController::class, 'destroy'])->name('vehiculos.destroy');
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
