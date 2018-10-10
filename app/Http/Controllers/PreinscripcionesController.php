<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Preinscripciones;
use App\Http\Resources\Preinscripciones as PreinscripcionesResource;
use Validator;
use Illuminate\Http\Response;

class PreinscripcionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preinscripciones = Preinscripciones::all();
        if ($preinscripciones != null){
            $conversion = PreinscripcionesResource::collection($preinscripciones);
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
            'medicamento_id' => 'required|integer|exists:medicamentos,id',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $preinscripcionCrear = new Preinscripciones;
            $preinscripcionCrear->mascota_id = $request->input('mascota_id');
            $preinscripcionCrear->medicamento_id = $request->input('medicamento_id');
            $preinscripcionCrear->save();
            return response()->json($preinscripcionCrear)->setStatusCode(201);
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
        $preinscripcionMostrar = Preinscripciones::findOrFail($id);
        if ($preinscripcionMostrar != null){
            $conversion = new PreinscripcionesResource($preinscripcionMostrar);
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
            'exists' => 'El valor del campo: :attribute no existe en la tabla que hace referencia.',
            'date' => 'El campo: :attribute, debe de ser una fecha con el formato adecuado.',
            'integer' => 'El campo: :attribute, debe contener números enteros.',
        ];
        $validator = Validator::make($request->all(), [
            'mascota_id' => 'required|integer|exists:mascotas,id',
            'medicamento_id' => 'required|integer|exists:medicamentos,id',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $preinscripcionActualizar = Preinscripciones::findOrFail($id);
            $preinscripcionActualizar->mascota_id = $request->input('mascota_id');
            $preinscripcionActualizar->medicamento_id = $request->input('medicamento_id');
            $preinscripcionActualizar->save();
            return response()->json($preinscripcionActualizar)->setStatusCode(201);
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
        $preinscripciones = Preinscripciones::where('id',$id)->first();
        if ($preinscripciones != null){
            $preinscripciones->delete();
            $message = array("message" => "Elemento eliminado correctamente.");
            return response()->json($message)->setStatusCode(200);
        }
        $message = array("message" => "El elemento ya ha sido eliminado.");
        return response()->json($message)->setStatusCode(410);
    }
}
