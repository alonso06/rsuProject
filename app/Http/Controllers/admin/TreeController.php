<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Families;
use App\Models\admin\Species;
use App\Models\admin\Trees;
use App\Models\admin\Zones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trees = Trees::select('trees.*', 'zones.name as zone_name', 'species.name as specie_name')
        ->join('zones', 'trees.zone_id', '=', 'zones.id')
        ->join('species', 'trees.specie_id', '=', 'species.id')
        ->get();
        return view('admin.trees.index', compact('trees'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zones = Zones::pluck('name','id');
        $families = Families::pluck('name','id');
        $species = Species::pluck('name','id');
        return view('admin.trees.create', compact('zones', 'families', 'species'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        Trees::create(['name'=> $request->name, 
        'zone_id'=> $request->zone_id, 
        'family_id'=> $request->family_id,
        'specie_id'=> $request->specie_id, 
        'birth_date'=> $request->birth_date, 
        'planting_date'=> $request->planting_date, 
        'latitude'=> $request->latitude, 
        'longitude'=> $request->longitude, 
        'description'=> $request->description, 
        'user_id'=>$user_id]);
        return Redirect()->route('admin.trees.index')->with('success', 'Árbol registrado');
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
        $zones = Zones::pluck('name','id');
        $families = Families::pluck('name','id');
        $species = Species::pluck('name','id');
        $tree = Trees::find($id);
        return view('admin.trees.edit', compact('tree','zones','families','species'));
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
        $tree = Trees::find($id);
        $tree->update($request->all());
        return Redirect()->route('admin.trees.index')->with('success','Arbol actualizado');
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
        $tree = Trees::find($id);
        $tree->delete();
        return Redirect()->route('admin.trees.index')->with('success','Árbol eliminado');
    }

    public function searchTree ($name )
    {

        $trees = Trees::where('name', 'LIKE', '%' . $name . '%')->get();
        return view('admin.shared.showSearchTrees', ['trees' => $trees]);
    }
}
