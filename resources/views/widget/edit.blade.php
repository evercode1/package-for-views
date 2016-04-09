@extends('layouts.master')

@section('title')

    <title>Edit Widget</title>

@endsection

@section('content')


        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/widget'>Widget</a></li><li><a href='/widget/{{$widget->id}}'>{{$widget->widget_name}}</a></li><li class='active'>Edit</li></ol>

        <h1>Edit Widget</h1>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/widget/'. $widget->id) }}">
        <input type="hidden" name="_method" value="patch">
        {!! csrf_field() !!}

        <!-- widget_name Form Input -->
            <div class="form-group{{ $errors->has('widget_name') ? ' has-error' : '' }}">
                <label class="control-label">Widget Name</label>

                    <input type="text" class="form-control" name="widget_name" value="{{ $widget->widget_name }}">

                    @if ($errors->has('widget_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('widget_name') }}</strong>
                                    </span>
                    @endif

            </div>

            <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Edit
                    </button>
            </div>

        </form>


@endsection