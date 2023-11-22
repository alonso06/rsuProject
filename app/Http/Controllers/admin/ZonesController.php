<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Zones;
use App\Models\admin\Trees;
use Illuminate\Http\Request;

class ZonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zones::all();
        return view('admin.zones.index', compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.zones.create',compact('is_zone'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Zones::create($request->all());
        return Redirect()->route('admin.zones.index')->with('success','Zona Registrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zone = Zones::find($id);
        $treeByZone = Trees::select('trees.*', 'zones.name as zone_name', 'species.name as specie_name')
        ->join('zones', 'trees.zone_id', '=', 'zones.id')
        ->join('species', 'trees.specie_id', '=', 'species.id')
        ->where('zone_id',$id)
        ->get();
        return view('admin.zones.show', compact('zone','treeByZone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zone = Zones::find($id);
        return view('admin.zones.edit', compact('zone'));
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
        $zone = Zones::find($id);
        $zone->update($request->all());
        return Redirect()->route('admin.zones.index')->with('success','Zona actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zone = Zones::find($id);
        $zone->delete();
        return Redirect()->route('admin.zones.index')->with('success','Zona eliminada');
    }
}
