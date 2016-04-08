<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\AlphaWidget;
use Illuminate\Support\Facades\Redirect;

class AlphaWidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('alpha-widget.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alpha-widget.create');
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
            'alpha_widget_name' => 'required|unique:alpha_widgets|alpha_num|max:30',

        ]);

        $alphaWidget = AlphaWidget::create(['alpha_widget_name' => $request->alpha_widget_name]);
        $alphaWidget->save();

        return Redirect::route('alpha-widget.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alphaWidget = AlphaWidget::findOrFail($id);

        return view('alpha-widget.show', compact('alphaWidget'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alphaWidget = AlphaWidget::findOrFail($id);

        return view('alpha-widget.edit', compact('alphaWidget'));
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
            'alpha_widget_name' => 'required|string|max:40|unique:alpha_widgets,alpha_widget_name,' .$id

        ]);
        $alphaWidget = AlphaWidget::findOrFail($id);
        $alphaWidget->update(['alpha_widget_name' => $request->alpha_widget_name]);


        return Redirect::route('alpha-widget.show', ['alphaWidget' => $alphaWidget]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AlphaWidget::destroy($id);

        return Redirect::route('alpha-widget.index');
    }
}
