<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Orange;
use Illuminate\Support\Facades\Redirect;

class OrangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('orange.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orange.create');
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
            'orange_name' => 'required|unique:oranges|string|max:30',

        ]);

        $orange = Orange::create(['orange_name' => $request->orange_name]);
        $orange->save();

        return Redirect::route('orange.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orange = Orange::findOrFail($id);

        return view('orange.show', compact('orange'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orange = Orange::findOrFail($id);

        return view('orange.edit', compact('orange'));
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
            'orange_name' => 'required|string|max:40|unique:oranges,orange_name,' .$id

        ]);
        $orange = Orange::findOrFail($id);
        $orange->update(['orange_name' => $request->orange_name]);


        return Redirect::route('orange.show', ['orange' => $orange]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Orange::destroy($id);

        return Redirect::route('orange.index');
    }
}