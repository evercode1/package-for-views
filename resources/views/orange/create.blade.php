@extends('layouts.master')

@section('title')

    <title>Create a Orange</title>

@endsection

@section('content')

        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/orange'>Orange</a></li><li class='active'>Create</li></ol>

        <h2>Create a New Orange</h2>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/orange') }}">

        {!! csrf_field() !!}

        <!-- orange_name Form Input -->
            <div class="form-group{{ $errors->has('orange_name') ? ' has-error' : '' }}">
                <label class="control-label">Orange Name</label>

                    <input type="text" class="form-control" name="orange_name" value="{{ old('orange_name') }}">

                    @if ($errors->has('orange_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('orange_name') }}</strong>
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