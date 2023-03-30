<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCapacitacionRequest;
use App\Http\Requests\UpdateCapacitacionRequest;
use App\Models\Capacitacion;
use Illuminate\Http\Request;

class CapacitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $capacitaciones = Capacitacion::all();
        return view('capacitaciones.index', compact(['capacitaciones']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('capacitaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveCapacitacionRequest $request)
    {
        $data = $request->validated();

        $capacitacion = new Capacitacion($data);

        try {
            $dia_semana = date('w', strtotime($capacitacion->fecha));

            if ($dia_semana < 1 )
                throw new \Exception("No se puede crear una capacitación el día Domingo");

            if ($dia_semana > 5 )
                throw new \Exception("No se puede crear una capacitación el día Sabado");

        } catch (\Throwable $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }

        try {

            $capacitacion->saveOrFail();

            return redirect('capacitaciones')->with('notifications', 'Capacitación creada');

        } catch (\Throwable $e) {
            return redirect('capacitaciones')->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $capacitacion = Capacitacion::find($id);
        return view('capacitaciones.edit', compact('capacitacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCapacitacionRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $capacitacion = Capacitacion::find($id);

            $capacitacion->updateOrFail($data);

            return redirect('capacitaciones')->with('notifications', 'Capacitación creada');
        } catch (\Throwable $e) {
            return redirect('capacitaciones')->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $capacitacion = Capacitacion::find($id);

            $capacitacion->estado = false;

            $capacitacion->saveOrFail();

            return redirect('capacitaciones')->with('notifications', 'Capacitación Inactivada');
        } catch (\Throwable $e) {
            return redirect('capacitaciones')->withErrors(['error' => $e->getMessage()]);
        }
    }
}
