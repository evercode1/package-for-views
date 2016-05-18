@extends('layouts.master')

@section('title')

    <title>Edit Blue</title>

@endsection

@section('content')


        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/blue'>Blue</a></li>
        <li><a href='/blue/{{$blue->id}}'>{{$blue->blue_name}}</a></li>
        <li class='active'>Edit</li>
        </ol>

        <h1>Edit Blue</h1>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/blue/'. $blue->id) }}">
        <input type="hidden" name="_method" value="patch">
        {!! csrf_field() !!}

        <!-- blue_name Form Input -->
            <div class="form-group{{ $errors->has('blue_name') ? ' has-error' : '' }}">
                <label class="control-label">Blue Name</label>

                    <input type="text" class="form-control" name="blue_name" value="{{ $blue->blue_name }}">

                    @if ($errors->has('blue_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('blue_name') }}</strong>
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