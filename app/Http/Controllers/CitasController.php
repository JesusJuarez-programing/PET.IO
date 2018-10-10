<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Citas;
use App\Http\Resources\Citas as CitasResource;
use Validator;
use Illuminate\Http\Response;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citas = Citas::all();
        $conversion = CitasResource::collection($citas);
        return response()->json($conversion)->setStatusCode(200);
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
            'exists' => 'El valor del campo: :attribute no existe en la tabla que hace referencia.',
            'date' => 'El campo: :attribute, debe de ser una fecha con el formato adecuado.',
        ];
        $validator = Validator::make($request->all(), [
            'mascota_id' => 'required|integer|exists:mascotas,id',
            'doctor_id' => 'required|integer|exists:doctores,id',
            'fecha_hora' => 'required|date',
            'tipo' => 'required|string',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $citaCrear = new Citas;
            $citaCrear->mascota_id = $request->input('mascota_id');
            $citaCrear->doctor_id = $request->input('doctor_id');
            $citaCrear->fecha_hora = $request->input('fecha_hora');
            $citaCrear->tipo = $request->input('tipo');
            $citaCrear->save();
            return response()->json($citaCrear)->setStatusCode(201);
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
        $citaMostrar = Citas::findOrFail($id);
        $conversion = new CitasResource($citaMostrar);
        return response()->json($conversion)->setStatusCode(200);
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
            'exists' => 'El valor del campo: :attribute no existe en la tabla que hace referencia.',
            'date' => 'El campo: :attribute, debe de ser una fecha con el formato adecuado.',
        ];
        $validator = Validator::make($request->all(), [
            'mascota_id' => 'required|integer|exists:mascotas,id',
            'doctor_id' => 'required|integer|exists:doctores,id',
            'fecha_hora' => 'required|date',
            'tipo' => 'required|string',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $citaActualizar =Citas::findOrFail($id);
            $citaActualizar->mascota_id = $request->input('mascota_id');
            $citaActualizar->doctor_id = $request->input('doctor_id');
            $citaActualizar->fecha_hora = $request->input('fecha_hora');
            $citaActualizar->tipo = $request->input('tipo');
            $citaActualizar->save();
            return response()->json($citaActualizar)->setStatusCode(201);
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
        $cita = Citas::where('id',$id)->first();
        if ($cita != null){
            $cita->delete();
            $message = array("message" => "Elemento eliminado correctamente.");
            return response()->json($message)->setStatusCode(200);
        }
        $message = array("message" => "El elemento ya ha sido eliminado.");
        return response()->json($message)->setStatusCode(410);
    }
}
