<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\admin\Families;
use App\Models\admin\Species;
use App\Models\admin\Trees;
use App\Models\admin\Zones;

class TreeControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            // $user = Auth::user();
            $trees = Trees::select('trees.*', 'zones.name as zone_name', 'species.name as specie_name')
            ->join('zones', 'trees.zone_id', '=', 'zones.id')
            ->join('species', 'trees.specie_id', '=', 'species.id')
            ->get();
            return response()->json($trees, 200);
        } catch(\Illuminate\Auth\AuthenticationException $e){
            return response()->json([
                'error' => 'No autenticado',
                'message' => 'Acceso no autorizado. Inicie sesión para acceder a esta función.',
            ], 401);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $zones = Zones::pluck('name','id');
            $families = Families::pluck('name','id');
            $species = Species::pluck('name','id');
            return response()->json([$zones,$families,$species], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => $e->getMessage(),
            ], 500);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // $user = Auth::user();
            // $user_id = $user->id;
            
            // Validacion para usuario
            $request->validate([
                'name' => 'required',
                // 'zone_id' => 'required',
            ]);
         
            
            $tree = Trees::create([
            'name'=> $request->name, 
            'zone_id'=> $request->zone_id, 
            'family_id'=> $request->family_id,
            'specie_id'=> $request->specie_id, 
            'birth_date'=> $request->birth_date, 
            'planting_date'=> $request->planting_date, 
            'latitude'=> $request->latitude, 
            'longitude'=> $request->longitude, 
            'description'=> $request->description, 
            'user_id'=>1]);

            return response()->json([
                'message' => 'Árbol creado corectamente',
                'tree' => $tree
            ], 200);
            
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => $e->getMessage(),
            ], 500);
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
        try {

            $zones = Zones::pluck('name','id');
            $families = Families::pluck('name','id');
            $species = Species::pluck('name','id');
            $tree = Trees::find($id);
            return response()->json([
                $zones, 
                $families, 
                $species,
                $tree
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => $e->getMessage(),
            ], 500);
        }
        
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
        try {
            $tree = Trees::find($id);
            $tree->update($request->all());
            return response()->json([
                'message' => 'Árbol actualizado corectamente',
                'tree' => $tree
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => $e->getMessage(),
            ], 500);
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
        try {
            $tree = Trees::find($id);
            $tree->delete();
            return response()->json([
                'message' => 'Árbol eliminado corectamente'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => $e->getMessage(),
            ], 500);        }
    }
}
