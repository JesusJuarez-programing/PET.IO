<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mascotas;
use App\Http\Resources\Mascotas as MascotasResource;
use Validator;
use Illuminate\Http\Response;

class MascotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mascotas = Mascotas::all();
        if ($mascotas != null){
            $conversion = MascotasResource::collection($mascotas);
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
            'exists' => 'El valor del campo: :attribute no existe en la tabla que hace referencia.',
        ];
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'edad' => 'required|integer',
            'dueño_id' => 'required|exists:dueños,id',
            'raza' => 'required|string',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $mascotaCrear = new Mascotas;
            $mascotaCrear->nombre = $request->input('nombre');
            $mascotaCrear->edad = $request->input('edad');
            $mascotaCrear->dueño_id = $request->input('dueño_id');
            $mascotaCrear->raza = $request->input('raza');
            $mascotaCrear->save();
            return response()->json($mascotaCrear)->setStatusCode(201);
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
        $mascotaMostrar = Mascotas::findOrFail($id);
        if ($mascotaMostrar != null){
            $conversion = new MascotasResource($mascotaMostrar);
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
    public function edit($id)
    {
        $messages = [
            'required' => 'El campo: :attribute, es requerido.',
            'string' => 'El campo: :attribute, debe de ser texto.',
            'integer' => 'El campo: :attribute, debe contener números enteros.',
            'exists' => 'El valor del campo: :attribute no existe en la tabla que hace referencia.',
        ];
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'edad' => 'required|integer',
            'dueño_id' => 'required|exists:dueños,id',
            'raza' => 'required|string',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $mascotaActualizar = Mascotas::findOrFail($id);
            $mascotaActualizar->nombre = $request->input('nombre');
            $mascotaActualizar->edad = $request->input('edad');
            $mascotaActualizar->dueño_id = $request->input('dueño_id');
            $mascotaActualizar->raza = $request->input('raza');
            $mascotaActualizar->save();
            return response()->json($mascotaActualizar)->setStatusCode(201);
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
        $mascota = Mascotas::where('id',$id)->first();
        if ($mascota != null){
            $mascota->delete();
            $message = array("message" => "Elemento eliminado correctamente.");
            return response()->json($message)->setStatusCode(200);
        }
        $message = array("message" => "El elemento ya ha sido eliminado.");
        return response()->json($message)->setStatusCode(410);
    }
}
