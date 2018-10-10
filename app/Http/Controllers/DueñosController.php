<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dueños;
use App\Http\Resources\Dueños as DueñosResource;
use Validator;
use Illuminate\Http\Response;

class DueñosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dueños = Dueños::all();
        if ($dueños != null){
            $conversion = DueñosResource::collection($dueños);
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
            'string' => 'El campo: :attribute, debe contener texto.',
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
            $dueñosCrear = new Dueños;
            $dueñosCrear->nombre = $request->input('nombre');
            $dueñosCrear->apellidos = $request->input('apellidos');
            $dueñosCrear->edad = $request->input('edad');
            $dueñosCrear->direccion = $request->input('direccion');
            $dueñosCrear->telefono = $request->input('telefono');
            $dueñosCrear->save();
            return response()->json($dueñosCrear)->setStatusCode(201);
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
        $dueñosMostrar = Dueños::findOrFail($id);
        if ($dueñosMostrar != null){
            $conversion = new DueñosResource($dueñosMostrar);
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
            'string' => 'El campo: :attribute, debe contener texto.',
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
            $dueñosActualizar = Dueños::findOrFail($id);
            $dueñosActualizar->nombre = $request->input('nombre');
            $dueñosActualizar->apellidos = $request->input('apellidos');
            $dueñosActualizar->edad = $request->input('edad');
            $dueñosActualizar->direccion = $request->input('direccion');
            $dueñosActualizar->telefono = $request->input('telefono');
            $dueñosActualizar->save();
            return response()->json($dueñosActualizar)->setStatusCode(201);
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
        $dueños = Dueños::where('id',$id)->first();
        if ($dueños != null){
            $dueños->delete();
            $message = array("message" => "Elemento eliminado correctamente.");
            return response()->json($message)->setStatusCode(200);
        }
        $message = array("message" => "El elemento ya ha sido eliminado.");
        return response()->json($message)->setStatusCode(410);
    }
}
