@extends('layouts.master')

@section('title')

    <title>Edit BlackHammer</title>

@endsection

@section('content')


        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/black-hammer'>BlackHammer</a></li>
        <li><a href='/black-hammer/{{$blackHammer->id}}'>{{$blackHammer->black_hammer_name}}</a></li>
        <li class='active'>Edit</li>
        </ol>

        <h1>Edit BlackHammer</h1>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/black-hammer/'. $blackHammer->id) }}">
        <input type="hidden" name="_method" value="patch">
        {!! csrf_field() !!}

        <!-- black_hammer_name Form Input -->
            <div class="form-group{{ $errors->has('black_hammer_name') ? ' has-error' : '' }}">
                <label class="control-label">BlackHammer Name</label>

                    <input type="text" class="form-control" name="black_hammer_name" value="{{ $blackHammer->black_hammer_name }}">

                    @if ($errors->has('black_hammer_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('black_hammer_name') }}</strong>
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