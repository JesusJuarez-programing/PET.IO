<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacunas;
use App\Http\Resources\Vacunas as VacunasResource;
use Validator;
use Illuminate\Http\Response;

class VacunasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacunas = Vacunas::all();
        if ($vacunas != null){
            $conversion = VacunasResource::collection($vacunas);
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
            'medicamento_id' => 'required|integer|exists:medicamentos,id',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $medicamentosCrear = new Vacunas;
            $medicamentosCrear->mascota_id = $request->input('mascota_id');
            $medicamentosCrear->medicamento_id = $request->input('medicamento_id');
            $medicamentosCrear->save();
            return response()->json($medicamentosCrear)->setStatusCode(201);
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
        $vacunaMostrar = Vacunas::findOrFail($id);
        if ($vacunaMostrar != null){
            $conversion = new VacunasResource($vacunaMostrar);
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
            'medicamento_id' => 'required|integer|exists:medicamentos,id',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $medicamentosCrear = Vacunas::findOrFail($id);
            $medicamentosCrear->mascota_id = $request->input('mascota_id');
            $medicamentosCrear->medicamento_id = $request->input('medicamento_id');
            $medicamentosCrear->save();
            return response()->json($medicamentosCrear)->setStatusCode(201);
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
        $vacunas = Vacunas::where('id',$id)->first();
        if ($vacunas != null){
            $vacunas->delete();
            $message = array("message" => "Elemento eliminado correctamente.");
            return response()->json($message)->setStatusCode(200);
        }
        $message = array("message" => "El elemento ya ha sido eliminado.");
        return response()->json($message)->setStatusCode(410);
    }
}
