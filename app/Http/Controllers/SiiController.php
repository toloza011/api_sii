<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clientes;
use Illuminate\Support\Facades\Http;
use DataTables;

class SiiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = clientes::all();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<div class="btn-group">';
                           $btn = '<button class="btn btn-primary" id="btn-editar" data-id="'.$row->rut.'" data-toggle="modal" data-target="#modaleditar">Editar</button>';
                           $btn = $btn.'<button class="btn btn-danger ml-2" id="btn-eliminar" data-id="'.$row->rut.'" >Eliminar</button></div>';
                           return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

       

        return view('sii');
    }

    public function consultar(Request $request)
    {
        $rut = $request->rut;
        $response = Http::get('https://siichile.herokuapp.com/consulta', ['rut' => $rut]);
        if ($response) {
            $data = $response->json();
            return $data;
        } else {
            return false;

        }
    }

    public function guardar(Request $request)
    {

       /*  $validacion = $request->validate([
            "rut" => ["required", 'unique:clientes'],
            "razon_social" => ["required"],
        ]); */
        if($request->rut==null || $request->rut == ""){
            return response()->json([
                "mensaje" => "El RUT no puede estar vacio!",
                "status" => 500,
            ]);
        }
        $unico = clientes::where("rut",$request->rut)->count();
        
        if($unico === 0){
            $cliente = new Clientes();
            $cliente->rut = $request->rut;
            $cliente->razon_social = $request->razon_social;
            if ($request->actividades != null) {
                $actividad = $request->actividades[0]["giro"];
                $categoria = $request->actividades[0]["categoria"];
                $codigo = $request->actividades[0]["codigo"];
            } else {
                $actividad = "Sin Actividad";
                $categoria = "Sin Actividad";
                $codigo = "Sin Actividad";
            }
            $cliente->actividades = $actividad;
            $cliente->categoria = $categoria;
            $cliente->codigo = $codigo;
            $cliente->save();
            return response()->json([
                "mensaje" => "Cliente almacenado exitosamente!",
                "status" => 200,
                "cliente" => $cliente
            ]);
        }else{
            return response()->json([
                "mensaje" => "El cliente ya se encuentra registrado",
                "status" => 500,
            ]);
        }
        
    }

    public function editar($rut,Request $request){

        $cliente = clientes::where("rut",$rut)->get();
        return $cliente[0];
    }

    public function update($rut,Request $request){
        $cliente = clientes::where("rut",$rut)->update([
            'razon_social'=> $request->razon_social,
            'actividades'=> $request->actividad,
            'categoria'=>$request->categoria,
            'codigo'=>$request->codigo
        ]);
        return response()->json([
            "mensaje" => "Cliente actualizado exitosamente!",
            "status" => 200,
            "cliente" => $cliente
        ]);

    }
    public function delete($rut,Request $request){
        $cliente = clientes::where("rut",$rut)->delete();
        return response()->json([
            "mensaje" => "Cliente Eliminado exitosamente!",
            "status" => 200,
        ]);

    }
}
