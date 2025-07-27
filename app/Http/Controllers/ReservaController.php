<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Illuminate\Support\Carbon;

class ReservaController extends Controller
{
    public function create()
    {
        return view('reservas');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i:s',
        ]);

        // Combinar fecha y hora en un solo datetime
        $fechaCompleta = Carbon::createFromFormat('Y-m-d H:i:s', $request->fecha . ' ' . $request->hora);

        // Verificar si ya existe una reserva para ese momento exacto
        $existe = Reserva::where('fecha_reserva', $fechaCompleta)->exists();

        if ($existe) {
            return redirect()->route('reservas.create')->with('error', 'El turno ya está reservado en ese horario.');
        }

        // Crear la reserva
        Reserva::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'fecha_reserva' => $fechaCompleta,
            'servicio' => 'No especificado',
            'estado' => 'pendiente',
        ]);

        return redirect()->route('reservas.create')->with('success', '¡Reserva realizada con éxito!');
    }
}