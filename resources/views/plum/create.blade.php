@extends('layouts.master')

@section('title')

    <title>Create a Plum</title>

@endsection

@section('content')

        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/plum'>Plum</a></li><li class='active'>Create</li></ol>

        <h2>Create a New Plum</h2>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/plum') }}">

        {!! csrf_field() !!}

        <!-- plum_name Form Input -->
            <div class="form-group{{ $errors->has('plum_name') ? ' has-error' : '' }}">
                <label class="control-label">Plum Name</label>

                    <input type="text" class="form-control" name="plum_name" value="{{ old('plum_name') }}">

                    @if ($errors->has('plum_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('plum_name') }}</strong>
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