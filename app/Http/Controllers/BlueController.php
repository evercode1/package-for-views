<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Blue;
use Illuminate\Support\Facades\Redirect;

class BlueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('blue.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blue.create');
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
            'blue_name' => 'required|unique:blues|string|max:30',

        ]);

        $slug = str_slug($request->blue_name, "-");

        $blue = Blue::create(['blue_name' => $request->blue_name,
                                                                  'slug' => $slug,]);
        $blue->save();

        return Redirect::route('blue.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug='')
    {
        $blue = Blue::findOrFail($id);

        if ($blue->slug !== $slug) {

            return Redirect::route('blue.show', ['id' => $blue->id,
                                                   'slug' => $blue->slug], 301);
        }

        return view('blue.show', compact('blue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blue = Blue::findOrFail($id);

        return view('blue.edit', compact('blue'));
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
            'blue_name' => 'required|string|max:40|unique:blues,blue_name,' .$id

        ]);
        $blue = Blue::findOrFail($id);

        $slug = str_slug($request->blue_name, "-");

        $blue->update(['blue_name' => $request->blue_name,
                                       'slug' => $slug,]);


        return Redirect::route('blue.show', ['blue' => $blue, 'slug' => $slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blue::destroy($id);

        return Redirect::route('blue.index');
    }
}