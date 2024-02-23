<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residentes;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use mysqli;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\registrarPago;
use App\Models\HistorialPago;



class ResidentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \illuminate\Http\Response
     */
   // In the index method

   public function index(Request $request)
{
    $texto = $request->input('texto');

    // Realizar la búsqueda utilizando Eloquent
    $residentes = Residentes::where('apellidos', 'like', '%' . $texto . '%')
        ->orWhere('id_resident', 'like', '%' . $texto . '%')
        ->get();

    // Pasar los datos a la vista
    return view('residentes.index', ['residentes' => $residentes, 'texto' => $texto]);
}

// Inside your controller class
public function search(Request $request)
{
    $text = $request->input('texto');

    // Perform the search query using the retrieved text
    $results = Residentes::where('apellidos', 'like', '%' . $text . '%')
        ->orWhere('nid_resident', 'like', '%' . $text . '%')
        ->get();

    // Return the results to a view
    return view('residentes.search', ['results' => $results, 'text' => $text]);
}



public function registrarPago($residenteId, $monto)
{
    $historialPago = new HistorialPago([
        'monto' => $monto,
        'fecha' => now(), // Opcional: ajusta la fecha según tus necesidades
    ]);

    $residente = Residentes::find($residenteId);
    $residente->historialPagos()->save($historialPago);

    // Resto de la lógica para registrar el pago...
}








public function pdf()
{
    $residentes=Residentes::all();
    $pdf = Pdf::loadView('residentes.pdf', \compact('residentes'));
    return $pdf->stream();
}



    /**
     * Show the form for creating a new resource.
     *
     *@return  \illuminate\Http\Response
     */
    public function create()
    {
        return view('residentes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Verifica si ya existe un residente con los mismos apellidos e igual dirección
            if (Residentes::where('apellidos', $request->input('apellidos'))
                ->where('domicilio', $request->input('domicilio'))
                ->exists()) {
                return redirect()->route('residentes.create')->with('error', 'Ya existe un residente con estos apellidos y esta dirección.');
            }

            // Valida los datos
            $request->validate([
                'apellidos' => 'required|max:60',
                'nombre' => 'required|max:60',
                'domicilio' => 'required|max:60',
                'fecha_de_pago' => 'required|date',
                'concepto' => 'required|max:255',
                'tipo_pago' => 'required|max:50',
                'cantidad_pagar' => 'required|numeric',
                // Otras reglas de validación para otros campos
            ]);

            // Crea una instancia del modelo Residentes y asigna los valores
            $residente = new Residentes;
            $residente->apellidos = $request->input('apellidos');
            $residente->nombre = $request->input('nombre');
            $residente->domicilio = $request->input('domicilio');
            $residente->fecha_de_pago = $request->input('fecha_de_pago');
            $residente->concepto = $request->input('concepto');
            $residente->tipo_pago = $request->input('tipo_pago');
            $residente->cantidad_pagar = $request->input('cantidad_pagar');

            // Intenta guardar el registro
            if ($residente->save()) {
                return redirect()->route('residentes.index')->with('success', 'Residente creado exitosamente');
            } else {
                return redirect()->route('residentes.create')->with('error', 'Error al guardar el residente');
            }
        } catch (\Exception $e) {
            // Captura cualquier excepción que ocurra durante el proceso
            return redirect()->route('residentes.create')->with('error', $e->getMessage());
        }
    }


    public function show(string $id_resident)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_resident)
    {
        $residentes=Residentes::findOrFail($id_resident);
       return view('residentes.edit',compact('residentes'));
    }

    /**
     * Update the specified resource in storage.
     * @param \illuminate\Http\Request $request
     * @param int $id
     * @return \illuminate\Http\Response
     */
    public function update(Request $request, string $id_resident)
    {
        $residentes=Residentes::findOrFail($id_resident);
        $residentes->apellidos=$request->input('apellidos');
        $residentes->nombre=$request->input('nombre');
        $residentes->domicilio=$request->input('domicilio');
        $residentes->fecha_de_pago=$request->input('fecha_de_pago');
        $residentes->concepto=$request->input('concepto');
        $residentes->tipo_pago=$request->input('tipo_pago');
        $residentes->cantidad_pagar=$request->input('cantidad_pagar');
        $residentes->save();
        return redirect()->route('residentes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_resident)
    {
        $residentes=Residentes::findOrFail($id_resident);
        $residentes->delete();
        return redirect()->route('residentes.index');
    }
}
