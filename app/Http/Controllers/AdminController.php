<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;

class AdminController extends Controller
{
    public function index()
    {
        $reservas = Reserva::all(); // Podés agrupar/ordenar por fecha si querés
        return view('admin', compact('reservas'));
    }
    public function actualizarTurno(Request $request)
    {
        $reserva = Reserva::find($request->id);
        if (!$reserva) {
            return redirect()->route('admin')->with('error', 'No se encontró el turno.');
        }

        $reserva->estado = $request->estado;

        if ($request->filled('fecha') && $request->filled('hora')) {
            $reserva->fecha_reserva = $request->fecha;
            $reserva->hora_reserva = $request->hora;

        }

        $reserva->save();

        return redirect()->route('admin')->with('success', 'Turno actualizado correctamente.');
    }
}

