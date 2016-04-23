<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Apple;
use Illuminate\Support\Facades\Redirect;

class AppleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('apple.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apple.create');
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
            'apple_name' => 'required|unique:apples|alpha_num|max:30',

        ]);

        $apple = Apple::create(['apple_name' => $request->apple_name]);
        $apple->save();

        return Redirect::route('apple.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apple = Apple::findOrFail($id);

        return view('apple.show', compact('apple'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apple = Apple::findOrFail($id);

        return view('apple.edit', compact('apple'));
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
            'apple_name' => 'required|string|max:40|unique:apples,apple_name,' .$id

        ]);
        $apple = Apple::findOrFail($id);
        $apple->update(['apple_name' => $request->apple_name]);


        return Redirect::route('apple.show', ['apple' => $apple]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Apple::destroy($id);

        return Redirect::route('apple.index');
    }
}