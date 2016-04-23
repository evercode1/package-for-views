@extends('layouts.master')

@section('title')

    <title>Edit BigDrum</title>

@endsection

@section('content')


        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/big-drum'>BigDrum</a></li>
        <li><a href='/big-drum/{{$bigDrum->id}}'>{{$bigDrum->big_drum_name}}</a></li>
        <li class='active'>Edit</li>
        </ol>

        <h1>Edit BigDrum</h1>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/big-drum/'. $bigDrum->id) }}">
        <input type="hidden" name="_method" value="patch">
        {!! csrf_field() !!}

        <!-- big_drum_name Form Input -->
            <div class="form-group{{ $errors->has('big_drum_name') ? ' has-error' : '' }}">
                <label class="control-label">BigDrum Name</label>

                    <input type="text" class="form-control" name="big_drum_name" value="{{ $bigDrum->big_drum_name }}">

                    @if ($errors->has('big_drum_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('big_drum_name') }}</strong>
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