@extends('layouts.master')

@section('title')

    <title>Edit Orange-peel</title>

@endsection

@section('content')


        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/orange-peel'>Orange-peel</a></li>
        <li><a href='/orange-peel/{{$orangePeel->id}}'>{{$orangePeel->orange-peel_name}}</a></li>
        <li class='active'>Edit</li>
        </ol>

        <h1>Edit Orange-peel</h1>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/orange-peel/'. $orangePeel->id) }}">
        <input type="hidden" name="_method" value="patch">
        {!! csrf_field() !!}

        <!-- orange-peel_name Form Input -->
            <div class="form-group{{ $errors->has('orange-peel_name') ? ' has-error' : '' }}">
                <label class="control-label">Orange-peel Name</label>

                    <input type="text" class="form-control" name="orange-peel_name" value="{{ $orangePeel->orange-peel_name }}">

                    @if ($errors->has('orange-peel_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('orange-peel_name') }}</strong>
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