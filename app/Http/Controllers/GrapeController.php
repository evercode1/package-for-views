<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Grape;
use Illuminate\Support\Facades\Redirect;

class GrapeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('grape.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grape.create');
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
            'grape_name' => 'required|unique:grapes|alpha_num|max:30',

        ]);

        $grape = Grape::create(['grape_name' => $request->grape_name]);
        $grape->save();

        return Redirect::route('grape.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grape = Grape::findOrFail($id);

        return view('grape.show', compact('grape'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grape = Grape::findOrFail($id);

        return view('grape.edit', compact('grape'));
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
            'grape_name' => 'required|string|max:40|unique:grapes,grape_name,' .$id

        ]);
        $grape = Grape::findOrFail($id);
        $grape->update(['grape_name' => $request->grape_name]);


        return Redirect::route('grape.show', ['grape' => $grape]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Grape::destroy($id);

        return Redirect::route('grape.index');
    }
}