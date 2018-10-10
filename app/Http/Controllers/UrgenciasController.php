<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Urgencias;
use App\Http\Resources\Urgencias as UrgenciasResource;
use Validator;
use Illuminate\Http\Response;

class UrgenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urgencias = Urgencias::all();
        if ($urgencias != null){
            $conversion = UrgenciasResource::collection($urgencias);
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
            'exists' => 'El valor del campo: :attribute no existe en la tabla que hace referencia.',
            'integer' => 'El campo: :attribute, debe contener números enteros.',
        ];
        $validator = Validator::make($request->all(), [
            'mascota_id' => 'required|integer|exists:mascotas,id',
            'doctor_id' => 'required|integer|exists:doctores,id',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $urgenciaCrear = new Urgencias;
            $urgenciaCrear->mascota_id = $request->input('mascota_id');
            $urgenciaCrear->doctor_id = $request->input('doctor_id');
            $urgenciaCrear->save();
            return response()->json($urgenciaCrear)->setStatusCode(201);
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
        $urgenciaMostrar = Urgencias::findOrFail($id);
        if ($urgenciaMostrar != null){
            $conversion = new UrgenciasResource($urgenciaMostrar);
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
            'exists' => 'El valor del campo: :attribute no existe en la tabla que hace referencia.',
            'integer' => 'El campo: :attribute, debe contener números enteros.',
        ];
        $validator = Validator::make($request->all(), [
            'mascota_id' => 'required|integer|exists:mascotas,id',
            'doctor_id' => 'required|integer|exists:doctores,id',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $urgenciaActualizar = Urgencias::findOrFail($id);
            $urgenciaActualizar->mascota_id = $request->input('mascota_id');
            $urgenciaActualizar->doctor_id = $request->input('doctor_id');
            $urgenciaActualizar->save();
            return response()->json($urgenciaActualizar)->setStatusCode(201);
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
        $urgencias = Urgencias::where('id',$id)->first();
        if ($urgencias != null){
            $urgencias->delete();
            $message = array("message" => "Elemento eliminado correctamente.");
            return response()->json($message)->setStatusCode(200);
        }
        $message = array("message" => "El elemento ya ha sido eliminado.");
        return response()->json($message)->setStatusCode(410);
    }
}
