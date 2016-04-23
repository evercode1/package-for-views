@extends('layouts.master')

@section('title')

    <title>Edit Plum</title>

@endsection

@section('content')


        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/plum'>Plum</a></li>
        <li><a href='/plum/{{$plum->id}}'>{{$plum->plum_name}}</a></li>
        <li class='active'>Edit</li>
        </ol>

        <h1>Edit Plum</h1>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/plum/'. $plum->id) }}">
        <input type="hidden" name="_method" value="patch">
        {!! csrf_field() !!}

        <!-- plum_name Form Input -->
            <div class="form-group{{ $errors->has('plum_name') ? ' has-error' : '' }}">
                <label class="control-label">Plum Name</label>

                    <input type="text" class="form-control" name="plum_name" value="{{ $plum->plum_name }}">

                    @if ($errors->has('plum_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('plum_name') }}</strong>
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