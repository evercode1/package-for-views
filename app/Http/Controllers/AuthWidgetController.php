<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\AuthWidget;
use Illuminate\Support\Facades\Redirect;

class AuthWidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('auth-widget.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth-widget.create');
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
            'auth_widget_name' => 'required|unique:auth_widgets|string|max:30',

        ]);

        $authWidget = AuthWidget::create(['auth_widget_name' => $request->auth_widget_name]);
        $authWidget->save();

        return Redirect::route('auth-widget.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $authWidget = AuthWidget::findOrFail($id);

        return view('auth-widget.show', compact('authWidget'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authWidget = AuthWidget::findOrFail($id);

        return view('auth-widget.edit', compact('authWidget'));
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
            'auth_widget_name' => 'required|string|max:40|unique:auth_widgets,auth_widget_name,' .$id

        ]);
        $authWidget = AuthWidget::findOrFail($id);
        $authWidget->update(['auth_widget_name' => $request->auth_widget_name]);


        return Redirect::route('auth-widget.show', ['authWidget' => $authWidget]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AuthWidget::destroy($id);

        return Redirect::route('auth-widget.index');
    }
}