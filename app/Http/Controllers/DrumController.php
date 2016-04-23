<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Drum;
use Illuminate\Support\Facades\Redirect;

class DrumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('drum.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drum.create');
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
            'drum_name' => 'required|unique:drums|alpha_num|max:30',

        ]);

        $drum = Drum::create(['drum_name' => $request->drum_name]);
        $drum->save();

        return Redirect::route('drum.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $drum = Drum::findOrFail($id);

        return view('drum.show', compact('drum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drum = Drum::findOrFail($id);

        return view('drum.edit', compact('drum'));
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
            'drum_name' => 'required|string|max:40|unique:drums,drum_name,' .$id

        ]);
        $drum = Drum::findOrFail($id);
        $drum->update(['drum_name' => $request->drum_name]);


        return Redirect::route('drum.show', ['drum' => $drum]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Drum::destroy($id);

        return Redirect::route('drum.index');
    }
}