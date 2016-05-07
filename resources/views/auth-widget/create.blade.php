@extends('layouts.master')

@section('title')

    <title>Create a AuthWidget</title>

@endsection

@section('content')

        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/auth-widget'>AuthWidget</a></li><li class='active'>Create</li></ol>

        <h2>Create a New AuthWidget</h2>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/auth-widget') }}">

        {!! csrf_field() !!}

        <!-- auth_widget_name Form Input -->
            <div class="form-group{{ $errors->has('auth_widget_name') ? ' has-error' : '' }}">
                <label class="control-label">AuthWidget Name</label>

                    <input type="text" class="form-control" name="auth_widget_name" value="{{ old('auth_widget_name') }}">

                    @if ($errors->has('auth_widget_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('auth_widget_name') }}</strong>
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