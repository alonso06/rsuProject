<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Evolutions;
use App\Models\admin\States;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvolutionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evolutions = Evolutions::select(
            'evolutions.id',
            'evolutions.date', 
            'trees.name as name_tree',
            'states.name as name_state'
        )
        ->join('trees', 'evolutions.tree_id', '=', 'trees.id')
        ->join('states', 'evolutions.state_id', '=', 'states.id')
        ->get();
        
        return view('admin.evolutions.index', compact('evolutions'));

    }

    /**
     * Show the form for creating a new resource.::info('msjSystem');
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = States::pluck('name', 'id');
        return view('admin.evolutions.create', compact('states'));
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

        return Redirect()->route('admin.evolutions.index')->with('success', 'Evolución registrada');
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
    }


}
