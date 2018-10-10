<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctores;
use App\Http\Resources\Doctores as DoctoresResource;
use Validator;
use Illuminate\Http\Response;

class DoctoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctores = Doctores::all();
        if ($doctores != null){
            $conversion = DoctoresResource::collection($doctores);
            return response()->json($conversion)->setStatusCode(200);
        }
        $message = array("message" => "No se encontraron elementos.");
        return response()->json($message)->setStatusCode(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'El campo: :attribute, es requerido.',
            'string' => 'El campo: :attribute, debe de ser texto.',
            'integer' => 'El campo: :attribute, debe contener números enteros.',
        ];
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'edad' => 'required|integer',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $doctorCrear = new Doctores;
            $doctorCrear->nombre = $request->input('nombre');
            $doctorCrear->apellidos = $request->input('apellidos');
            $doctorCrear->edad = $request->input('edad');
            $doctorCrear->direccion = $request->input('direccion');
            $doctorCrear->telefono = $request->input('telefono');
            $doctorCrear->save();
            return response()->json($doctorCrear)->setStatusCode(201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctorMostrar = Doctores::findOrFail($id);
        if ($doctorMostrar != null){
            $conversion = new DoctoresResource($doctorMostrar);
            return response()->json($conversion)->setStatusCode(200);
        }
        $message = array("message" => "No se encontraro el elemento.");
        return response()->json($message)->setStatusCode(404);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'El campo: :attribute, es requerido.',
            'string' => 'El campo: :attribute, debe de ser texto.',
            'integer' => 'El campo: :attribute, debe contener números enteros.',
        ];
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'edad' => 'required|integer',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $doctorActualizar = Doctores::findOrFail($id);
            $doctorActualizar->nombre = $request->input('nombre');
            $doctorActualizar->apellidos = $request->input('apellidos');
            $doctorActualizar->edad = $request->input('edad');
            $doctorActualizar->direccion = $request->input('direccion');
            $doctorActualizar->telefono = $request->input('telefono');
            $doctorActualizar->save();
            return response()->json($doctorActualizar)->setStatusCode(201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctores::where('id',$id)->first();
        if ($doctor != null){
            $doctor->delete();
            $message = array("message" => "Elemento eliminado correctamente.");
            return response()->json($message)->setStatusCode(200);
        }
        $message = array("message" => "El elemento ya ha sido eliminado.");
        return response()->json($message)->setStatusCode(410);
    }
}
