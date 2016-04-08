@extends('layouts.master')

@section('title')

    <title>Edit AlphaWidget</title>

@endsection

@section('content')


        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/alpha-widget'>AlphaWidget</a></li><li><a href='/alphaWidget/{{$alphaWidget->id}}'>{{$alphaWidget->alpha_widget_name}}</a></li><li class='active'>Edit</li></ol>

        <h1>Edit AlphaWidget</h1>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/alpha-widget/'. $alphaWidget->id) }}">
        <input type="hidden" name="_method" value="patch">
        {!! csrf_field() !!}

        <!-- alpha_widget_name Form Input -->
            <div class="form-group{{ $errors->has('alpha_widget_name') ? ' has-error' : '' }}">
                <label class="control-label">AlphaWidget Name</label>

                    <input type="text" class="form-control" name="alpha_widget_name" value="{{ $alphaWidget->alpha_widget_name }}">

                    @if ($errors->has('alpha_widget_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('alpha_widget_name') }}</strong>
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