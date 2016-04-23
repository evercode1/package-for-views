<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Loaf;
use Illuminate\Support\Facades\Redirect;

class LoafController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('loaf.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loaf.create');
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
            'loaf_name' => 'required|unique:loaves|alpha_num|max:30',

        ]);

        $loaf = Loaf::create(['loaf_name' => $request->loaf_name]);
        $loaf->save();

        return Redirect::route('loaf.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loaf = Loaf::findOrFail($id);

        return view('loaf.show', compact('loaf'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loaf = Loaf::findOrFail($id);

        return view('loaf.edit', compact('loaf'));
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
            'loaf_name' => 'required|string|max:40|unique:loaves,loaf_name,' .$id

        ]);
        $loaf = Loaf::findOrFail($id);
        $loaf->update(['loaf_name' => $request->loaf_name]);


        return Redirect::route('loaf.show', ['loaf' => $loaf]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Loaf::destroy($id);

        return Redirect::route('loaf.index');
    }
}