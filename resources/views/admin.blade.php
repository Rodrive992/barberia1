@extends('layouts.app')

@section('title', 'Panel de Turnos')

@push('styles')
  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <style>
    #calendar {
      max-width: 100%;
      margin: 2rem auto;
      padding: 10px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
    }

    .fc .fc-toolbar-title {
      text-transform: capitalize !important;
      font-family: 'Oswald', sans-serif;
      font-size: 1.5rem;
      color: #222;
    }

    .fc-event-title {
      white-space: normal !important;
      font-size: 0.85rem;
    }

    .fc-event {
      padding: 2px 4px;
      line-height: 1.1;
    }

    @media (max-width: 768px) {
      .fc .fc-toolbar {
        flex-wrap: wrap;
        gap: 0.5rem;
      }
    }
          /* Estilos para el modal */
      .modal-content {
        border: none;
        border-radius: var(--radius-8);
        box-shadow: var(--shadow-2);
        overflow: hidden;
      }

      .modal-header {
        background-color: var(--eerie-black-1);
        color: var(--white);
        padding: 1.25rem;
        border-bottom: 3px solid var(--indian-yellow);
      }

      .modal-title {
        font-family: var(--ff-oswald);
        font-weight: var(--fw-600);
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
      }

      .modal-body {
        padding: 1.5rem;
      }

      .modal-footer {
        padding: 1rem 1.5rem;
        background-color: var(--platinum);
        border-top: 1px solid var(--light-gray);
      }

      .close {
        color: var(--white);
        opacity: 0.8;
        text-shadow: none;
      }

      .close:hover {
        color: var(--indian-yellow);
        opacity: 1;
      }

      /* Estilos específicos del contenido */
      .turno-info {
        background-color: var(--platinum);
        padding: 1rem;
        border-radius: var(--radius-5);
      }

      .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
      }

      .info-item:last-child {
        margin-bottom: 0;
      }

      .info-item .icon {
        color: var(--indian-yellow);
        margin-right: 1rem;
        width: 20px;
        text-align: center;
      }

      .info-label {
        font-weight: var(--fw-600);
        color: var(--eerie-black-1);
        font-size: var(--fs-14);
        display: block;
      }

      .info-value {
        color: var(--sonic-silver);
        font-size: var(--fs-14);
      }

      .divider {
        border: none;
        height: 1px;
        background-color: var(--light-gray);
        margin: 1.5rem 0;
      }

      .form-section {
        margin-top: 1.5rem;
      }

      .section-title {
        font-family: var(--ff-oswald);
        font-size: var(--fs-16);
        font-weight: var(--fw-600);
        color: var(--eerie-black-1);
        margin-bottom: 1.25rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
      }

      .form-label {
        font-family: var(--ff-rubik);
        font-weight: var(--fw-600);
        color: var(--eerie-black-1);
        font-size: var(--fs-14);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
      }

      /* Botones */
      .btn-primary {
        background-color: var(--indian-yellow);
        border-color: var(--indian-yellow);
        color: var(--white);
        font-family: var(--ff-oswald);
        font-weight: var(--fw-600);
        letter-spacing: 0.5px;
        text-transform: uppercase;
        padding: 0.5rem 1.25rem;
        transition: var(--transition-1);
      }

      .btn-primary:hover {
        background-color: var(--harvest-gold);
        border-color: var(--harvest-gold);
        transform: translateY(-2px);
      }

      .btn-secondary {
        background-color: var(--sonic-silver);
        border-color: var(--sonic-silver);
        color: var(--white);
        font-family: var(--ff-oswald);
        font-weight: var(--fw-600);
        letter-spacing: 0.5px;
        padding: 0.5rem 1.25rem;
        transition: var(--transition-1);
      }

      .btn-secondary:hover {
        background-color: var(--jet);
        border-color: var(--jet);
        transform: translateY(-2px);
      }

      /* Responsive */
      @media (max-width: 576px) {
        .modal-dialog {
          margin: 0.5rem;
        }
        
        .modal-body {
          padding: 1rem;
        }
        
        .info-item {
          flex-direction: column;
          align-items: flex-start;
        }
        
        .info-item .icon {
          margin-bottom: 0.25rem;
        }
      }
  </style>
@endpush

@section('content')
<section class="section" id="admin">
  <div class="container section-box">
    <h2 class="section-title text-center mb-4">Turnos Agendados</h2>

    @if(session('success'))
      <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div id="calendar"></div>

    <!-- Modal -->
    <div class="modal fade" id="modalTurno" tabindex="-1" role="dialog" aria-labelledby="modalTurnoLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" action="{{ route('admin.actualizar-turno') }}" class="modal-form">
          @csrf
          <input type="hidden" name="id" id="modalTurnoId">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTurnoLabel">
                <i class="fas fa-calendar-check mr-2"></i>Gestionar Turno
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="turno-info mb-4">
                <div class="info-item">
                  <i class="fas fa-user icon"></i>
                  <div>
                    <span class="info-label">Nombre:</span>
                    <span id="modalTurnoNombre" class="info-value"></span>
                  </div>
                </div>
                
                <div class="info-item">
                  <i class="fas fa-phone icon"></i>
                  <div>
                    <span class="info-label">Teléfono:</span>
                    <span id="modalTurnoTelefono" class="info-value"></span>
                  </div>
                </div>
                
                <div class="info-item">
                  <i class="fas fa-clock icon"></i>
                  <div>
                    <span class="info-label">Fecha y hora:</span>
                    <span id="modalTurnoFechaHora" class="info-value"></span>
                  </div>
                </div>
              </div>

              <hr class="divider">

              <div class="form-section">
                <h6 class="section-title">
                  <i class="fas fa-cog mr-2"></i>Configuración del turno
                </h6>
                
                <div class="form-group">
                  <label for="nuevoEstado" class="form-label">
                    <i class="fas fa-flag mr-1"></i>Estado
                  </label>
                  <select name="estado" id="nuevoEstado" class="form-control">
                    <option value="pendiente">Pendiente</option>
                    <option value="listo">Listo</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="nuevaFecha" class="form-label">
                    <i class="fas fa-calendar-day mr-1"></i>Reprogramar fecha
                  </label>
                  <input type="date" name="fecha" id="nuevaFecha" class="form-control" min="{{ now()->format('Y-m-d') }}">
                </div>

                <div class="form-group">
                  <label for="nuevaHora" class="form-label">
                    <i class="fas fa-clock mr-1"></i>Reprogramar hora
                  </label>
                  <select name="hora" id="nuevaHora" class="form-control">
                    @for ($h = 9; $h <= 20; $h++)
                      <option value="{{ sprintf('%02d:00:00', $h) }}">{{ sprintf('%02d:00', $h) }}</option>
                    @endfor
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-times mr-1"></i>Cancelar
              </button>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i>Guardar cambios
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
  <!-- jQuery (necesario para Bootstrap y modal) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FullCalendar JS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'es',
      timeZone: 'America/Argentina/Catamarca',
      initialView: window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth',
      nowIndicator: true,
      contentHeight: 'auto',
      handleWindowResize: true,
      aspectRatio: 1.35,
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: window.innerWidth < 768 ? '' : 'dayGridMonth,timeGridWeek,listWeek'
      },
      dayMaxEventRows: true,
      events: [
        @foreach($reservas as $reserva)
          {
            title: @json($reserva->nombre),
            start: '{{ $reserva->fecha_reserva }}T{{ $reserva->hora_reserva }}',
            backgroundColor: '{{ $reserva->estado === "listo" ? "#28a745" : "#dc3545" }}',
            borderColor: '{{ $reserva->estado === "listo" ? "#28a745" : "#dc3545" }}',
            extendedProps: {
              id: {{ $reserva->id }},
              telefono: @json($reserva->telefono),
              estado: @json($reserva->estado),
              hora: '{{ $reserva->hora_reserva }}',
              fecha: '{{ $reserva->fecha_reserva }}'
            }
          },
        @endforeach
      ],
          eventClick: function(info) {
      const turno = info.event;
      const props = turno.extendedProps;

      // Mostrar fecha y hora por separado
      const fechaLegible = props.fecha.split('-').reverse().join('/');
      const horaLegible = props.hora.slice(0, 5); // HH:mm

      document.getElementById('modalTurnoId').value = props.id;
      document.getElementById('modalTurnoNombre').textContent = turno.title;
      document.getElementById('modalTurnoTelefono').textContent = props.telefono;
      document.getElementById('modalTurnoFechaHora').textContent = `${fechaLegible} ${horaLegible} hs`;
      document.getElementById('nuevoEstado').value = props.estado;
      document.getElementById('nuevaFecha').value = props.fecha;
      document.getElementById('nuevaHora').value = props.hora;

      $('#modalTurno').modal('show');
    }
    });

    calendar.render();
  });
  </script>
@endpush