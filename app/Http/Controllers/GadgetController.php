<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Gadget;
use App\Widget;
use Illuminate\Support\Facades\Redirect;

class GadgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('gadget.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       $widgets = Widget::orderBy('widget_name', 'asc')->get();

        return view('gadget.create', compact('widgets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $count = Widget::count();

        $this->validate($request, [
            'gadget_name' => 'required|unique:gadgets|string|max:30',
            'widget_id' => "required|numeric|digits_between:1,$count"

        ]);

        $gadget = Gadget::create(['gadget_name' => $request->gadget_name,
                                                                  'widget_id'  => $request->widget_id]);
        $gadget->save();

        return Redirect::route('gadget.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gadget = Gadget::findOrFail($id);

         $widget = $gadget->widget->widget_name;

        return view('gadget.show', compact('gadget', 'widget'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gadget = Gadget::findOrFail($id);

        $widgets = Widget::orderBy('widget_name', 'asc')->get();

       $oldValue = $gadget->widget->widget_name;

       $oldId = $gadget->widget->id;

        return view('gadget.edit', compact('gadget', 'widgets', 'oldValue', 'oldId'));
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

        $count = Widget::count();

        $this->validate($request, [
            'gadget_name' => 'required|string|max:40|unique:gadgets,gadget_name,' .$id,
            'widget_id' => "required|numeric|digits_between:1,$count"

        ]);
        $gadget = Gadget::findOrFail($id);
        $gadget->update(['gadget_name' => $request->gadget_name,
                                       'widget_id'  => $request->widget_id
                                       ]);

        $widget = $gadget->widget->widget_name;


        return Redirect::route('gadget.show', ['gadget' => $gadget,
                                                        'widget' => $widget
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
        Gadget::destroy($id);

        return Redirect::route('gadget.index');
    }
}