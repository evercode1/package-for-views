@extends('layouts.master')

@section('title')

    <title>Create a BlackHammer</title>

@endsection

@section('content')

        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/black-hammer'>BlackHammer</a></li><li class='active'>Create</li></ol>

        <h2>Create a New BlackHammer</h2>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/black-hammer') }}">

        {!! csrf_field() !!}

        <!-- black_hammer_name Form Input -->
            <div class="form-group{{ $errors->has('black_hammer_name') ? ' has-error' : '' }}">
                <label class="control-label">BlackHammer Name</label>

                    <input type="text" class="form-control" name="black_hammer_name" value="{{ old('black_hammer_name') }}">

                    @if ($errors->has('black_hammer_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('black_hammer_name') }}</strong>
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