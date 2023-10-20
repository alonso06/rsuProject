<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\ProcedureTypes;
use Illuminate\Http\Request;

class ProcedureTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proceduretypes = ProcedureTypes::all();
        return view('admin.proceduretypes.index', compact('proceduretypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.proceduretypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProcedureTypes::create($request->all());
        return Redirect()->route('admin.proceduretypes.index')->with('success','Tipo de Procedimiento Registrado');
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
        $proceduretype = ProcedureTypes::find($id);
        return view('admin.proceduretypes.edit', compact('proceduretype'));
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
        $proceduretype = ProcedureTypes::find($id);
        $proceduretype->update($request->all());
        return Redirect()->route('admin.proceduretypes.index')->with('success','Tipo de Procedimiento Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proceduretype = ProcedureTypes::find($id);
        $proceduretype->delete();
        return Redirect()->route('admin.proceduretypes.index')->with('success','Tipo de Procedimiento Eliminado');
    }
}
