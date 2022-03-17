<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Redirect, Response;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClientePost;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clientes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientePost $request)
    {
        $cliente = new Cliente;
        $cliente->nombre = $request->nombre;
        $cliente->apellido_paterno = $request->apellido_paterno;
        $cliente->apellido_materno = $request->apellido_materno;
        $cliente->domicilio = $request->domicilio;
        $cliente->correo_electronico = $request->correo_electronico;
        $cliente->save();

        return response()->json([
            'statusCode' =>200,
            'message' =>"Datos guardados correctamente",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClientePost $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->nombre = $request->nombre;
        $cliente->apellido_paterno = $request->apellido_paterno;
        $cliente->apellido_materno = $request->apellido_materno;
        $cliente->domicilio = $request->domicilio;
        $cliente->correo_electronico = $request->correo_electronico;
        $cliente->save();
        
        return response()->json([
            'statusCode' =>200,
            'message' =>"Datos modificados correctamente",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return response()->json([
            'statusCode' =>200,
            'message' =>"Registro eliminado correctamente",
        ]);
    }

    public function obtenerClientes()
    {
        $clientes = Cliente::get();
        return ['clientes' => $clientes];
    }
}
