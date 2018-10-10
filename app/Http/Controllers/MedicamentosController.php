<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicamentos;
use App\Http\Resources\Medicamentos as MedicamentosResource;
use Validator;
use Illuminate\Http\Response;

class MedicamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicamentos = Medicamentos::all();
        if ($medicamentos != null){
            $conversion = MedicamentosResource::collection($medicamentos);
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
            'cantidad' => 'required|integer',
            'aplicacion' => 'required|string',
            'fabricante' => 'required|string',
            'existencia' => 'required|integer',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $medicamentosCrear = new Medicamentos;
            $medicamentosCrear->nombre = $request->input('nombre');
            $medicamentosCrear->cantidad = $request->input('cantidad');
            $medicamentosCrear->aplicacion = $request->input('aplicacion');
            $medicamentosCrear->fabricante = $request->input('fabricante');
            $medicamentosCrear->existencia = $request->input('existencia');
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
        $medicamentoMostrar = Medicamentos::findOrFail($id);
        if ($medicamentoMostrar != null){
            $conversion = new MedicamentosResource($medicamentoMostrar);
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
            'cantidad' => 'required|integer',
            'aplicacion' => 'required|string',
            'fabricante' => 'required|string',
            'existencia' => 'required|integer',
        ], $messages);
        
        if ($validator->fails())
        {
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        }
        else
        {
            $medicamentosActualizar = Medicamentos::findOrFail($id);
            $medicamentosActualizar->nombre = $request->input('nombre');
            $medicamentosActualizar->cantidad = $request->input('cantidad');
            $medicamentosActualizar->aplicacion = $request->input('aplicacion');
            $medicamentosActualizar->fabricante = $request->input('fabricante');
            $medicamentosActualizar->existencia = $request->input('existencia');
            $medicamentosActualizar->save();
            return response()->json($medicamentosActualizar)->setStatusCode(201);
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
        $medicamento = Medicamentos::where('id',$id)->first();
        if ($medicamento != null){
            $medicamento->delete();
            $message = array("message" => "Elemento eliminado correctamente.");
            return response()->json($message)->setStatusCode(200);
        }
        $message = array("message" => "El elemento ya ha sido eliminado.");
        return response()->json($message)->setStatusCode(410);
    }
}
