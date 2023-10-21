<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Procedures;
use App\Models\admin\ProcedureTypes;
use App\Models\admin\Responsibles;
use App\Models\admin\Trees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProceduresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procedures = Procedures::select('procedures.*', 'procedure_types.name as procedure_type_name','responsibles.name as responsibles_name', 'trees.name as tree_name')
        ->join('procedure_types', 'procedures.procedure_type_id', '=', 'procedure_types.id')
        ->join('responsibles', 'procedures.responsible_id', '=', 'responsibles.id')
        ->join('trees', 'procedures.tree_id', '=', 'trees.id')
        ->get();
        return view('admin.procedures.index', compact('procedures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $procedureTypes = ProcedureTypes::pluck('name','id');
        $responsibles = Responsibles::pluck('name','id');
        $trees = Trees::pluck('name','id');
        return view('admin.procedures.create', compact('trees','procedureTypes','responsibles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        

        //
        $user = Auth::user();
        $user_id = $user->id;

        $new_procedure = new Procedures();
        $new_procedure->date = $request->date;
        $new_procedure->description = $request->description;
        $new_procedure->procedure_type_id = $request->procedure_type_id;
        $new_procedure->tree_id = $request->tree_id;
        $new_procedure->responsible_id = $request->responsible_id;
        $new_procedure->user_id = $user_id;
       
        $new_procedure->save();

        return Redirect()->route('admin.procedures.index')->with('success', 'Procedimiento registrado');
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
        //
        $procedureTypes = ProcedureTypes::pluck('name','id');
        $responsibles = Responsibles::pluck('name','id');
        $trees = Trees::pluck('name','id');
        $procedure = Procedures::find($id);
        return view('admin.procedures.edit', compact('procedure','trees','procedureTypes','responsibles'));
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
        //
        $procedure = Procedures::find($id);
        $procedure->update($request->all());
        
        return Redirect()->route('admin.procedures.index')->with('success','Procedimiento actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $procedure = Procedures::find($id);
        $procedure->delete();
        return Redirect()->route('admin.procedures.index')->with('success','Procedimiento eliminado');
    }
}
