<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operaciones;
use App\Http\Resources\Operaciones as OperacionesResource;
use Validator;
use Illuminate\Http\Response;

class OperacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operaciones = Operaciones::all();
        if ($operaciones != null){
            $conversion =OperacionesResource::collection($operaciones);
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
            'exists' => 'El valor del campo: :attribute no existe en la tabla que hace referencia.',
            'date' => 'El campo: :attribute, debe de ser una fecha con el formato adecuado.',
            'integer' => 'El campo: :attribute, debe contener números enteros.',
        ];
        $validator = Validator::make($request->all(), [
            'mascota_id' => 'required|integer|exists:mascotas,id',
            'doctor_id' => 'required|integer|exists:doctores,id',
            'tipo' => 'required|string',
            'sala' => 'required|string',
            'fecha_hora' => 'required|date',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $operacionCrear = new Operaciones;
            $operacionCrear->mascota_id = $request->input('mascota_id');
            $operacionCrear->doctor_id = $request->input('doctor_id');
            $operacionCrear->tipo = $request->input('tipo');
            $operacionCrear->sala = $request->input('sala');
            $operacionCrear->fecha_hora = $request->input('fecha_hora');
            $operacionCrear->save();
            return response()->json($operacionCrear)->setStatusCode(201);
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
        $operacionesMostrar = Operaciones::findOrFail($id);
        if ($operacionesMostrar != null){
            $conversion = new OperacionesResource($operacionesMostrar);
            return response()->json($conversion)->setStatusCode(200);
        }
        $message = array("message" => "No se encontraro el elemento.");
        return response()->json($message)->setStatusCode(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'El campo: :attribute, es requerido.',
            'string' => 'El campo: :attribute, debe de ser texto.',
            'exists' => 'El valor del campo: :attribute no existe en la tabla que hace referencia.',
            'date' => 'El campo: :attribute, debe de ser una fecha con el formato adecuado.',
            'integer' => 'El campo: :attribute, debe contener números enteros.',
        ];
        $validator = Validator::make($request->all(), [
            'mascota_id' => 'required|integer|exists:mascotas,id',
            'doctor_id' => 'required|integer|exists:doctores,id',
            'tipo' => 'required|string',
            'sala' => 'required|string',
            'fecha_hora' => 'required|date',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $operacionActualizar = Operaciones::findOrFail($id);
            $operacionActualizar->mascota_id = $request->input('mascota_id');
            $operacionActualizar->doctor_id = $request->input('doctor_id');
            $operacionActualizar->tipo = $request->input('tipo');
            $operacionActualizar->sala = $request->input('sala');
            $operacionActualizar->fecha_hora = $request->input('fecha_hora');
            $operacionActualizar->save();
            return response()->json($operacionActualizar)->setStatusCode(201);
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
        $operaciones = Operaciones::where('id',$id)->first();
        if ($operaciones != null){
            $operaciones->delete();
            $message = array("message" => "Elemento eliminado correctamente.");
            return response()->json($message)->setStatusCode(200);
        }
        $message = array("message" => "El elemento ya ha sido eliminado.");
        return response()->json($message)->setStatusCode(410);
    }
}
