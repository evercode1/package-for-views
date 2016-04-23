<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\BigDrum;
use Illuminate\Support\Facades\Redirect;

class BigDrumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('big-drum.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('big-drum.create');
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
            'big_drum_name' => 'required|unique:big_drums|alpha_num|max:30',

        ]);

        $bigDrum = BigDrum::create(['big_drum_name' => $request->big_drum_name]);
        $bigDrum->save();

        return Redirect::route('big-drum.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bigDrum = BigDrum::findOrFail($id);

        return view('big-drum.show', compact('bigDrum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bigDrum = BigDrum::findOrFail($id);

        return view('big-drum.edit', compact('bigDrum'));
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
            'big_drum_name' => 'required|string|max:40|unique:big_drums,big_drum_name,' .$id

        ]);
        $bigDrum = BigDrum::findOrFail($id);
        $bigDrum->update(['big_drum_name' => $request->big_drum_name]);


        return Redirect::route('big-drum.show', ['bigDrum' => $bigDrum]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BigDrum::destroy($id);

        return Redirect::route('big-drum.index');
    }
}