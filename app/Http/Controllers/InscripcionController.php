<?php

namespace App\Http\Controllers;

use App\Models\Capacitacion;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $capacitaciones = DB::table('capacitaciones AS cap')
            ->leftJoin('inscripciones AS ins', 'cap.id', '=', 'ins.capacitacion_id')
            ->select(
                'cap.*',
                'ins.capacitacion_id',
                'ins.usuario_inscrito_id',
                'ins.asistencia',
                DB::raw('(cap.cupo - cap.numero_inscripciones) AS cupo_disponible')
            )
            ->where('cap.estado', '<>', 0)
            ->orderByDesc('cap.fecha')
            ->get();

        return view('inscripciones.index', compact(['capacitaciones']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $inscripcion = Inscripcion::where('capacitacion_id', $id)
            ->where('usuario_inscrito_id', Auth::user()->id)
            ->first()
        ;

        if (!$inscripcion) {
            $inscripcion = new Inscripcion([
                'capacitacion_id' => $id,
                'usuario_inscrito_id' => Auth::user()->id,
            ]);
        }

        try {
            $capacitacion = Capacitacion::find($inscripcion->capacitacion_id);

            $fecha_actual = date('Y-m-d');
            $hora_actual = date('H:s');

            if ($capacitacion->fecha < $fecha_actual) {
                throw new \Exception("Esta capacitación no tiene fecha Vigente");
            }

            if ($capacitacion->fecha == $fecha_actual && $capacitacion->hora_fin < $hora_actual) {
                throw new \Exception("Esta capacitación ya finalizo");
            }

            DB::transaction(function () use ($inscripcion, $capacitacion) {
                $inscripcion->saveOrFail();
                $inscripcion = (object) $inscripcion;

                $capacitacion->numero_inscripciones = ((int) $capacitacion->numero_inscripciones) + 1;
                $capacitacion->saveOrFail();
            });

            return redirect('inscripciones')->with('notifications', 'Inscripción correcta');
        } catch (\Throwable $e) {
            return redirect('inscripciones')->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inscripcion = Inscripcion::where('capacitacion_id', $id)
            ->where('usuario_inscrito_id', Auth::user()->id)
            ->first()
        ;

        try {
            DB::transaction(function () use ($inscripcion) {

                $inscripcion->asistencia = 0;
                $inscripcion->saveOrFail();
                $inscripcion = (object) $inscripcion;

                $capacitacion = Capacitacion::find($inscripcion->capacitacion_id);

                $capacitacion->numero_inscripciones = ((int) $capacitacion->numero_inscripciones) - 1;
                $capacitacion->saveOrFail();
            });

            return redirect('inscripciones')->with('notifications', 'Capacitacion Incativada');

        } catch (\Throwable $e) {
            return redirect('inscripciones')->withErrors(['error' => $e->getMessage()]);
        }
    }
}
