@extends('layouts.master')

@section('title')

    <title>Create a BigDrum</title>

@endsection

@section('content')

        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/big-drum'>BigDrum</a></li><li class='active'>Create</li></ol>

        <h2>Create a New BigDrum</h2>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/big-drum') }}">

        {!! csrf_field() !!}

        <!-- big_drum_name Form Input -->
            <div class="form-group{{ $errors->has('big_drum_name') ? ' has-error' : '' }}">
                <label class="control-label">BigDrum Name</label>

                    <input type="text" class="form-control" name="big_drum_name" value="{{ old('big_drum_name') }}">

                    @if ($errors->has('big_drum_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('big_drum_name') }}</strong>
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