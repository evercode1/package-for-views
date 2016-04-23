<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\BlackHammer;
use Illuminate\Support\Facades\Redirect;

class BlackHammerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('black-hammer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('black-hammer.create');
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
            'black_hammer_name' => 'required|unique:black_hammers|alpha_num|max:30',

        ]);

        $blackHammer = BlackHammer::create(['black_hammer_name' => $request->black_hammer_name]);
        $blackHammer->save();

        return Redirect::route('black-hammer.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blackHammer = BlackHammer::findOrFail($id);

        return view('black-hammer.show', compact('blackHammer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blackHammer = BlackHammer::findOrFail($id);

        return view('black-hammer.edit', compact('blackHammer'));
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
            'black_hammer_name' => 'required|string|max:40|unique:black_hammers,black_hammer_name,' .$id

        ]);
        $blackHammer = BlackHammer::findOrFail($id);
        $blackHammer->update(['black_hammer_name' => $request->black_hammer_name]);


        return Redirect::route('black-hammer.show', ['blackHammer' => $blackHammer]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BlackHammer::destroy($id);

        return Redirect::route('black-hammer.index');
    }
}