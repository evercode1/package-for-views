<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\LittleRed;
use App\Blue;
use Illuminate\Support\Facades\Redirect;

class LittleRedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('little-red.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       $blues = Blue::orderBy('blue_name', 'asc')->get();

        return view('little-red.create', compact('blues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $count = Blue::count();

        $this->validate($request, [
            'little_red_name' => 'required|unique:little_reds|string|max:30',
            'blue_id' => "required|numeric|digits_between:1,$count"

        ]);

        $slug = str_slug($request->little_red_name, "-");

        $littleRed = LittleRed::create(['little_red_name' => $request->little_red_name,
                                                                  'slug' => $slug,
                                                                  'blue_id'  => $request->blue_id]);
        $littleRed->save();

        return Redirect::route('little-red.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug='')
    {
        $littleRed = LittleRed::findOrFail($id);

        if ($littleRed->slug !== $slug) {

            return Redirect::route('little-red.show', ['id' => $littleRed->id,
                                                   'slug' => $littleRed->slug], 301);
        }

         $blue = $littleRed->blue->blue_name;

        return view('little-red.show', compact('littleRed', 'blue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $littleRed = LittleRed::findOrFail($id);

        $blues = Blue::orderBy('blue_name', 'asc')->get();

       $oldValue = $littleRed->blue->blue_name;

       $oldId = $littleRed->blue->id;

        return view('little-red.edit', compact('littleRed', 'blues', 'oldValue', 'oldId'));
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

        $count = Blue::count();

        $this->validate($request, [
            'little_red_name' => 'required|string|max:40|unique:little_reds,little_red_name,' .$id,
            'blue_id' => "required|numeric|digits_between:1,$count"

        ]);
        $littleRed = LittleRed::findOrFail($id);

        $slug = str_slug($request->little_red_name, "-");

        $littleRed->update(['little_red_name' => $request->little_red_name,
                                       'slug' => $slug,
                                       'blue_id'  => $request->blue_id
                                       ]);


        return Redirect::route('little-red.show', ['littleRed' => $littleRed,
                                                        'slug' => $slug
                                                        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LittleRed::destroy($id);

        return Redirect::route('little-red.index');
    }
}