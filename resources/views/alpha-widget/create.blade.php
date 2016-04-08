@extends('layouts.master')

@section('title')

    <title>Create a AlphaWidget</title>

@endsection

@section('content')

        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/alpha-widget'>AlphaWidget</a></li><li class='active'>Create</li></ol>

        <h2>Create a New AlphaWidget</h2>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/alpha-widget') }}">

        {!! csrf_field() !!}

        <!-- alpha_widget_name Form Input -->
            <div class="form-group{{ $errors->has('alpha_widget_name') ? ' has-error' : '' }}">
                <label class="control-label">AlphaWidget Name</label>

                    <input type="text" class="form-control" name="alpha_widget_name" value="{{ old('alpha_widget_name') }}">

                    @if ($errors->has('alpha_widget_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('alpha_widget_name') }}</strong>
                                    </span>
                    @endif

            </div>


            <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Create
                    </button>
            </div>

        </form>

@endsection