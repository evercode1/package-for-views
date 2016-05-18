@extends('layouts.master')

@section('title')

    <title>Edit LittleRed</title>

@endsection

@section('content')


        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/little-red'>LittleRed</a></li>
        <li><a href='/little-red/{{$littleRed->id}}'>{{$littleRed->little_red_name}}</a></li>
        <li class='active'>Edit</li>
        </ol>

        <h1>Edit LittleRed</h1>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/little-red/'. $littleRed->id) }}">
        <input type="hidden" name="_method" value="patch">
        {!! csrf_field() !!}

        <!-- little_red_name Form Input -->
            <div class="form-group{{ $errors->has('little_red_name') ? ' has-error' : '' }}">
                <label class="control-label">LittleRed Name</label>

                    <input type="text" class="form-control" name="little_red_name" value="{{ $littleRed->little_red_name }}">

                    @if ($errors->has('little_red_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('little_red_name') }}</strong>
                                    </span>
                    @endif

            </div>

            <div class="form-group{{ $errors->has('blue_id') ? ' has-error' : '' }}">

                <label for="blue_id">Blue Name:</label>
                <select class="form-control" name="blue_id">

                    <option value="{{ $oldId }}">{{ $oldValue }}</option>

                    @foreach($blues as $blue)

                        <option value="{{ $blue->id }}">{{ $blue->blue_name }}</option>

                    @endforeach

                </select>



                @if ($errors->has('blue_id'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('blue_id') }}</strong>
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