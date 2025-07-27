@extends('layouts.app')

@section('title', 'Reservá tu turno')

@section('content')
<section class="section" id="reserva">
  <div class="container section-box" style="max-width: 600px; margin: auto;">
    <h2 class="section-title text-center mb-4">Reservá tu turno</h2>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show text-center mb-4">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show text-center mb-4">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <form action="{{ route('reservas.store') }}" method="POST" class="reservation-form">
      @csrf

      <div class="form-group mb-4">
        <label for="nombre" class="form-label">
          <i class="fas fa-user icon"></i> Nombre completo
        </label>
        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese su nombre completo" required>
        <small class="form-text">Ej: Juan Pérez</small>
      </div>

      <div class="form-group mb-4">
        <label for="telefono" class="form-label">
          <i class="fas fa-phone icon"></i> Teléfono
        </label>
        <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="3834123456" pattern="[0-9]{10}" required>
        <small class="form-text">Ej: 3834123456 (sin 0 ni 15)</small>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group mb-4">
            <label for="fecha" class="form-label">
              <i class="fas fa-calendar-alt icon"></i> Fecha
            </label>
            <input type="date" id="fecha" name="fecha" class="form-control" min="{{ now()->format('Y-m-d') }}" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-4">
            <label for="hora" class="form-label">
              <i class="fas fa-clock icon"></i> Hora
            </label>
            <select id="hora" name="hora" class="form-control" required>
              <option value="" disabled selected>Seleccione una hora</option>
              @for ($i = 9; $i <= 20; $i++)
                <option value="{{ sprintf('%02d:00:00', $i) }}">{{ sprintf('%02d:00', $i) }} hs</option>
              @endfor
            </select>
          </div>
        </div>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-reservation">
          <span>Confirmar reserva</span>
          <i class="fas fa-check-circle ml-2"></i>
        </button>
      </div>
    </form>
  </div>
</section>
@endsection