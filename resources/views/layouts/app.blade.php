<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>@yield('title', 'Barbería Catamarca')</title>
  <meta name="description" content="Barbería y Peluquería en Catamarca. Servicios profesionales, promociones y contacto directo.">

  <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  @stack('styles')
</head>

<body id="top">

  @if(request()->is('admin'))
    <!-- Header para /admin -->
    <header class="header bg-dark py-3">
      <div class="container d-flex justify-content-between align-items-center">
        <h1 class="text-white mb-0" style="font-family: 'Oswald', sans-serif;">Administrador de Turnos</h1>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger">
            <i class="fas fa-sign-out-alt"></i> Salir
          </button>
        </form>
      </div>
    </header>
  @else
    <!-- Header para sitio público -->
    <header class="header">
      <div class="header-top">
        <div class="container">
          <ul class="header-top-list">
            <li class="header-top-item">
              <ion-icon name="call-outline" aria-hidden="true"></ion-icon>
              <a href="https://wa.me/543834534010" target="_blank" class="item-link">WhatsApp 3834-534010</a>
            </li>
            <li class="header-top-item">
              <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
              <p class="item-text">Lunes - Sábados, 08:00 - 21:00</p>
            </li>
          </ul>
        </div>
      </div>

      <div class="header-bottom">
        <div class="container">
          <div class="header-bottom-content">
            <a href="#" class="logo">Barbería <span class="span">Catamarca</span></a>
            
            <!-- Botón hamburguesa para móviles -->
            <button class="navbar-toggle" aria-label="Menú" aria-expanded="false">
              <span class="toggle-icon"></span>
              <span class="toggle-icon"></span>
              <span class="toggle-icon"></span>
            </button>
            
            <nav class="navbar" id="navbar">
              <ul class="navbar-list">
                <li class="navbar-item"><a href="{{ route('inicio') }}" class="navbar-link">Inicio</a></li>
                <li class="navbar-item"><a href="{{ url('/#servicios') }}" class="navbar-link">Servicios</a></li>
                <li class="navbar-item"><a href="{{ url('/#galeria') }}" class="navbar-link">Galería</a></li>
                <li class="navbar-item"><a href="{{ url('/#ubicacion') }}" class="navbar-link">Ubicación</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </header>
  @endif

  <main>
    @yield('content')
  </main>

  <footer class="footer">
    <div class="container">
      <p>© 2025 Barbería Catamarca. Todos los derechos reservados.</p>
    </div>
  </footer>

  <a href="#top" class="back-top-btn" aria-label="Volver arriba">
    <i class="fas fa-chevron-up"></i>
  </a>

  <script src="{{ asset('assets/js/script.js') }}" defer></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
  <script>
    // Script para el menú hamburguesa
    document.addEventListener('DOMContentLoaded', function() {
      const toggleBtn = document.querySelector('.navbar-toggle');
      const navbar = document.getElementById('navbar');
      
      toggleBtn.addEventListener('click', function() {
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !isExpanded);
        navbar.classList.toggle('active');
        this.classList.toggle('active');
      });
      
      // Cerrar menú al hacer clic en un enlace (para móviles)
      const navLinks = document.querySelectorAll('.navbar-link');
      navLinks.forEach(link => {
        link.addEventListener('click', function() {
          if (window.innerWidth <= 768) {
            navbar.classList.remove('active');
            toggleBtn.setAttribute('aria-expanded', 'false');
            toggleBtn.classList.remove('active');
          }
        });
      });
    });
  </script>
  
  @stack('scripts')
</body>
</html>