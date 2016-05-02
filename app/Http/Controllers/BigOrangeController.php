<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\BigOrange;
use Illuminate\Support\Facades\Redirect;

class BigOrangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('big-orange.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('big-orange.create');
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
            'big_orange_name' => 'required|unique:big_oranges|string|max:30',

        ]);

        $bigOrange = BigOrange::create(['big_orange_name' => $request->big_orange_name]);
        $bigOrange->save();

        return Redirect::route('big-orange.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bigOrange = BigOrange::findOrFail($id);

        return view('big-orange.show', compact('bigOrange'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bigOrange = BigOrange::findOrFail($id);

        return view('big-orange.edit', compact('bigOrange'));
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
            'big_orange_name' => 'required|string|max:40|unique:big_oranges,big_orange_name,' .$id

        ]);
        $bigOrange = BigOrange::findOrFail($id);
        $bigOrange->update(['big_orange_name' => $request->big_orange_name]);


        return Redirect::route('big-orange.show', ['bigOrange' => $bigOrange]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BigOrange::destroy($id);

        return Redirect::route('big-orange.index');
    }
}