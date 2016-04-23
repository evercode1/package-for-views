@extends('layouts.master')

@section('title')

    <title>Create a Orange-peel</title>

@endsection

@section('content')

        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/orange-peel'>Orange-peel</a></li><li class='active'>Create</li></ol>

        <h2>Create a New Orange-peel</h2>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/orange-peel') }}">

        {!! csrf_field() !!}

        <!-- orange-peel_name Form Input -->
            <div class="form-group{{ $errors->has('orange-peel_name') ? ' has-error' : '' }}">
                <label class="control-label">Orange-peel Name</label>

                    <input type="text" class="form-control" name="orange-peel_name" value="{{ old('orange-peel_name') }}">

                    @if ($errors->has('orange-peel_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('orange-peel_name') }}</strong>
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