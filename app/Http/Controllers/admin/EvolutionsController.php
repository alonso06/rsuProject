<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Evolutions;
use App\Models\admin\States;
use App\Models\admin\Trees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvolutionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index( $tree_id )
    // { 

    // }

    // Index
    public function listEvolutions( int $tree_id )
    {
        $name_tree = TreeController::searchTreeById( $tree_id );
        
        $evolutions = Evolutions::select(
            'evolutions.id',
            'evolutions.date', 
            'states.name as name_state'
        )
        ->join('trees', 'evolutions.tree_id', '=', 'trees.id')
        ->join('states', 'evolutions.state_id', '=', 'states.id')
        ->where('evolutions.tree_id', $tree_id)
        ->get();
        
        return view('admin.evolutions.index', compact('evolutions', 'name_tree', 'tree_id'));

    }

    /**
     * Show the form for creating a new resource.::info('msjSystem');
     *
     * @return \Illuminate\Http\Response
     */

    // Create
    public function createTree( int $tree_id ){

        // return $tree_id;

        $states = States::pluck('name', 'id');
        
        return view('admin.evolutions.create', compact('states', 'tree_id'));

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

        Evolutions::create([
            'date'          =>  $request->date,
            'height'        =>  $request->height,
            'width'         =>  $request->width,
            'description'   =>  $request->description,
            'tree_id'       =>  $request->tree_id,
            'state_id'      =>  $request->state_id,
            'user_id'       =>  $user_id,
        ]);

        return Redirect()->route('admin.evolutions.listEvolutions',['tree_id'=>$request->tree_id ])->with('success', 'Evolución registrada');
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
        $states = States::pluck('name', 'id');
        
        $evolution = Evolutions::find($id);

        $tree_id = $evolution->tree_id;
        
        return view('admin.evolutions.edit', compact('states', 'evolution', 'tree_id'));
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
        $evolution = Evolutions::find( $id );
        
        $evolution->update($request->all());

        return Redirect()->route('admin.evolutions.listEvolutions',['tree_id'=>$request->tree_id ])->with('success','Evolución actualizada');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evolution = Evolutions::find( $id );

        $evolution->delete();

        return Redirect()->route('admin.evolutions.listEvolutions',['tree_id'=>$evolution->tree_id ])->with('success','Evolución eliminada');
        
    }


}
