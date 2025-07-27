@extends('layouts.app')

@section('title', 'Inicio - Barbería Catamarca')

@section('content') 
    <!-- HERO -->
    <section class="section hero" id="home" style="background-image: url('./assets/images/hero-banner.jpg')">
      <div class="container">
        <h1 class="hero-title">Barb&Hair Catamarca</h1>
        <p class="hero-text">Estilo y cuidado profesional. Pedí tu turno por WhatsApp.</p>
       <a href="{{ route('reservas.create') }}" class="btn">
          <span>¡Reservar ahora!</span>
          <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </section>

    <!-- SERVICIOS -->
    <section class="section" id="servicios">
      <div class="container section-box">
        <h2 class="section-title">Nuestros Servicios</h2>
        <ul class="grid-list">
          <li>
            <div class="pricing-card">
              <div class="pricing-icon">
                <i class="fas fa-cut"></i>
              </div>
              <div class="pricing-content">
                <h3 class="card-title">Barbería</h3>
                <p class="card-text">$5000</p>
                <ul class="pricing-features">
                  <li>Corte clásico</li>
                  <li>Afeitado tradicional</li>
                  <li>Arreglo de barba</li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="pricing-card">
              <div class="pricing-icon">
                <i class="fas fa-user"></i>
              </div>
              <div class="pricing-content">
                <h3 class="card-title">Peluquería</h3>
                <p class="card-text">$6000</p>
                <ul class="pricing-features">
                  <li>Corte moderno</li>
                  <li>Lavado incluido</li>
                  <li>Peinado profesional</li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="pricing-card">
              <div class="pricing-icon">
                <i class="fas fa-cut"></i>
                <i class="fas fa-user"></i>
              </div>
              <div class="pricing-content">
                <h3 class="card-title">Combo Completo</h3>
                <p class="card-text">$10000</p>
                <ul class="pricing-features">
                  <li>Barbería + Peluquería</li>
                  <li>Mascarilla nutritiva</li>
                  <li>Tratamiento capilar</li>
                </ul>
                <span class="promo-badge">Ahorrá $1000</span>
              </div>
            </div>
          </li>
          <li>
            <div class="pricing-card">
              <div class="pricing-icon">
                <i class="fas fa-fire"></i>
              </div>
              <div class="pricing-content">
                <h3 class="card-title">Promo Lunes</h3>
                <p class="card-text">20% OFF</p>
                <ul class="pricing-features">
                  <li>Todos los servicios</li>
                  <li>Solo días lunes</li>
                  <li>Reserva anticipada</li>
                </ul>
                <span class="promo-badge">Oferta especial</span>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </section>

    <!-- GALERÍA -->
    <section class="section" id="galeria">
      <div class="container section-box">
        <h2 class="section-title">Clientes Satisfechos</h2>
        <ul class="grid-list">
          <li>
            <div class="gallery-card">
              <div class="card-banner">
                <img src="{{ asset('assets/images/gallery-1.jpg') }}" loading="lazy" alt="Corte de pelo" class="img-cover">
              </div>
            </div>
          </li>
          <li>
            <div class="gallery-card">
              <div class="card-banner">
                <img src="{{ asset('assets/images/gallery-2.jpg') }}" loading="lazy" alt="Afeitado" class="img-cover">
              </div>
            </div>
          </li>
          <li>
            <div class="gallery-card">
              <div class="card-banner">
                <img src="{{ asset('assets/images/gallery-3.jpg') }}" loading="lazy" alt="Estilo de barba" class="img-cover">
              </div>
            </div>
          </li>
          <li>
            <div class="gallery-card">
              <div class="card-banner">
                <img src="{{ asset('assets/images/gallery-4.jpg') }}" loading="lazy" alt="Corte moderno" class="img-cover">
              </div>
            </div>
          </li>
        </ul>
      </div>
    </section>

    <!-- UBICACIÓN -->
    <section class="section" id="ubicacion">
      <div class="container section-box">
        <h2 class="section-title">Dónde estamos</h2>
        <p class="text-center">San Fernando del Valle de Catamarca</p>
        <div class="map-container">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3410.166933385401!2d-65.77922708458907!3d-28.469583382494595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94242471d0d40485%3A0xf6617b85ef048fe4!2sSan%20Fernando%20del%20Valle%20de%20Catamarca%2C%20Catamarca!5e0!3m2!1ses-419!2sar!4v1690415796776!5m2!1ses-419!2sar" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </section>
@endsection