<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login EPC</title>
    <link rel="stylesheet" href="{{ asset('styles/Estiloslogin.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="container" id="container">
        {{-- Formulario de Registro --}}
        <div class="container-form form-register">
            <form method="POST" action="{{ route('register') }}" class="sing-up">
                @csrf
                <h2>Registrarse</h2>
                <div class="logo">
                    <img src="{{ asset('img/logo_epc.webp') }}" alt="logo" />
                </div>
                <span>Use correo electrónico para registrarse</span>

                <div class="container-input">
                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" name="name" placeholder="Nombre" required />
                </div>

                <div class="container-input">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" name="email" placeholder="Email" required />
                </div>

                <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="password" placeholder="Password" required />
                </div>

                <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="password_confirmation" placeholder="Confirmar Password" required />
                </div>

                <button type="submit">REGISTRARSE</button>
            </form>
        </div>

        <div class="container-form form-login">
            <form class="sing-in" method="POST" action="{{ route('login') }}">
                @csrf
                <h2>Iniciar Sesión</h2>
                <div class="logo">
                    <img src="{{ asset('img/logo_epc.webp') }}" alt="logo" />
                </div>
                <span>Use correo y contraseña para iniciar sesión</span>
                <div class="container-input">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" placeholder="Email" name="email" required />
                </div>
                <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" placeholder="Password" name="password" required />
                </div>
                <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                <button type="submit">INICIAR SESIÓN</button>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h2>¡Hola!</h2>
                    <p>Ingrese sus datos personales y comience su viaje con nosotros</p>
                    <button class="ghost" id="btn-iniciar">Iniciar Sesión</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h2>¡Bienvenido de nuevo!</h2>
                    <p>Para mantenerse conectado, inicie sesión con su información personal</p>
                    <button class="ghost" id="btn-registrar">Registrarse</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btnRegistrar = document.getElementById('btn-registrar');
            const btnIniciar = document.getElementById('btn-iniciar');
            const container = document.getElementById('container');

            btnRegistrar.addEventListener('click', () => {
                container.classList.add("right-panel-active");
            });

            btnIniciar.addEventListener('click', () => {
                container.classList.remove("right-panel-active");
            });
        });
    </script>
</body>
</html>