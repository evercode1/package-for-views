<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\BigWidget;
use Illuminate\Support\Facades\Redirect;

class BigWidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('big-widget.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('big-widget.create');
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
            'big_widget_name' => 'required|unique:big_widgets|alpha_num|max:30',

        ]);

        $bigWidget = BigWidget::create(['big_widget_name' => $request->big_widget_name]);
        $bigWidget->save();

        return Redirect::route('big-widget.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bigWidget = BigWidget::findOrFail($id);

        return view('big-widget.show', compact('bigWidget'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bigWidget = BigWidget::findOrFail($id);

        return view('big-widget.edit', compact('bigWidget'));
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
            'big_widget_name' => 'required|string|max:40|unique:big_widgets,big_widget_name,' .$id

        ]);
        $bigWidget = BigWidget::findOrFail($id);
        $bigWidget->update(['big_widget_name' => $request->big_widget_name]);


        return Redirect::route('big-widget.show', ['bigWidget' => $bigWidget]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BigWidget::destroy($id);

        return Redirect::route('big-widget.index');
    }
}