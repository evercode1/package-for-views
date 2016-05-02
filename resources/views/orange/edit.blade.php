@extends('layouts.master')

@section('title')

    <title>Edit Orange</title>

@endsection

@section('content')


        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/orange'>Orange</a></li>
        <li><a href='/orange/{{$orange->id}}'>{{$orange->orange_name}}</a></li>
        <li class='active'>Edit</li>
        </ol>

        <h1>Edit Orange</h1>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/orange/'. $orange->id) }}">
        <input type="hidden" name="_method" value="patch">
        {!! csrf_field() !!}

        <!-- orange_name Form Input -->
            <div class="form-group{{ $errors->has('orange_name') ? ' has-error' : '' }}">
                <label class="control-label">Orange Name</label>

                    <input type="text" class="form-control" name="orange_name" value="{{ $orange->orange_name }}">

                    @if ($errors->has('orange_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('orange_name') }}</strong>
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