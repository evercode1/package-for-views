<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Plum;
use Illuminate\Support\Facades\Redirect;

class PlumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('plum.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plum.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'plum_name' => 'required|unique:plums|alpha_num|max:30',

        ]);

        $plum = Plum::create(['plum_name' => $request->plum_name]);
        $plum->save();

        return Redirect::route('plum.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plum = Plum::findOrFail($id);

        return view('plum.show', compact('plum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plum = Plum::findOrFail($id);

        return view('plum.edit', compact('plum'));
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
        $this->validate($request, [
            'plum_name' => 'required|string|max:40|unique:plums,plum_name,' .$id

        ]);
        $plum = Plum::findOrFail($id);
        $plum->update(['plum_name' => $request->plum_name]);


        return Redirect::route('plum.show', ['plum' => $plum]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Plum::destroy($id);

        return Redirect::route('plum.index');
    }
}