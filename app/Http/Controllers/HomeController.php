<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residentes;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use mysqli;
use App\Http\Controllers\Controller;
use App\Models\Residente;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;



use Barryvdh\DomPDF\Facade\Pdf as PDF;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('index');
        } else {
            return back()->withInput()->withErrors(['email' => 'Credenciales incorrectas']);
        }
    }

    public function postIndex(Request $request)
    {
        // Lógica para manejar la solicitud POST en /index
        // ...

        // Después de manejar la lógica, redirigir a la página de inicio de sesión
        return $this->mostrarPagina();
    }
   
   


    public function index(Request $request)
    {
        $texto = $request->input('texto');
        $residentes = Residentes::where('apellidos', 'like', '%' . $texto . '%')
            ->orWhere('id_resident', 'like', '%' . $texto . '%')
            ->get();

        return view('residentes.index', ['residentes' => $residentes, 'texto' => $texto]);
    }

    public function changepassword(Request $request, $userId)
    {
        // Validar la solicitud
        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        // Hashear la nueva contraseña
        $newPasswordHash = Hash::make($request->password);

        // Actualizar la contraseña en la base de datos
        $user = User::find($userId);
        $user->password = $newPasswordHash;
        $user->save();

        // Redirigir o devolver una respuesta
         // Redirigir al usuario
    return redirect()->back()->with('success', 'Contraseña actualizada correctamente');
    }

    public function generarPDF(Request $request, $id_resident)
    {
        // Obtener los datos del residente
        $residente = Residentes::findOrFail($id_resident);
    
        // Crear el contenido HTML con los datos del residente y la marca de agua
        $html_content = "
            <style>
                /* Estilos para la marca de agua */
                .marca-agua {
                    position: fixed;
                    top: 0%;
                    left: 6%;
                    transform: rotate(0deg);
                    color: #d0d0d0;
                    font-size: 63px;
                    opacity: 0.2;
                }
                /* Resto de estilos */
                body {
                    font-family: Arial, sans-serif;
                    margin: 20px;
                    background-color: #f8f9fa;
                }
                h2 {
                    text-align: center;
                    color: #007bff;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                th, td {
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                }
                th {
                    background-color: #f2f2f2;
                }
            </style>
            <body>
                <div class='marca-agua'>FRACCIONAMIENTO UNIDAD DEPORTIVA Y RESIDENCIAL ACOZAC A.C</div>
                <h2>Información del Residente</h2>
                <table>
                    <tr><th>ID_Residente</th><td>{$residente->id_resident}</td></tr>
                    <tr><th>Apellidos</th><td>{$residente->apellidos}</td></tr>
                    <tr><th>Nombre</th><td>{$residente->nombre}</td></tr>
                    <tr><th>Domicilio</th><td>{$residente->domicilio}</td></tr>
                    <tr><th>Fecha de Pago</th><td>{$residente->fecha_de_pago}</td></tr>
                    <tr><th>Concepto</th><td>{$residente->concepto}</td></tr>
                    <tr><th>Tipo de Pago</th><td>{$residente->tipo_pago}</td></tr>
                    <tr><th>Cantidad a Pagar</th><td>{$residente->cantidad_pagar}</td></tr>
                </table>
            </body>
        ";
    
        // Crear una instancia de Dompdf con opciones predeterminadas
        $dompdf = new Dompdf();
    
        // Cargar el contenido HTML en Dompdf
        $dompdf->loadHtml($html_content);
    
        // Renderizar el PDF
        $dompdf->render();
    
        // Descargar el PDF
        return $dompdf->stream("residente.pdf");
    }
    
    


    public function search(Request $request)
    {
        $texto = $request->input('texto');
        $results = Residentes::where(function($query) use ($texto) {
                        $query->where('apellidos', 'like', '%' . $texto . '%')
                              ->orWhere('id_resident', 'like', '%' . $texto . '%');
                    })
                    ->get();
    
        return view('residentes.search', ['residentes' => $results, 'texto' => $texto]);
    }
    

    public function search1(Request $request)
{
    $id_resident = $request->input('id_resident');
    $residente = Residentes::find($id_resident);

    return view('vigilante.search1', compact('residente'));
}

    public function pdf()
    {
        $residentes = Residentes::all();
        $pdf = PDF::loadView('residentes.pdf', ['residentes' => $residentes]);
        return $pdf->download('residentes.pdf');
    }

    public function imprimir($id_resident)
    {
        // Obtener la información del residente por ID
        $residente = Residentes::findOrFail($id_resident);

        // Retornar la vista para imprimir
        return view('residentes.imprimir', compact('residente'));
    }

    public function showChangePasswordForm()
    {
        return view('change-password');
    }


    public function mostrarPagina()
    {
        return redirect()->route('index');
    }

    // Resto de tus métodos y funciones...









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
