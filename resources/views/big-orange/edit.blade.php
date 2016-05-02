@extends('layouts.master')

@section('title')

    <title>Edit BigOrange</title>

@endsection

@section('content')


        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/big-orange'>BigOrange</a></li>
        <li><a href='/big-orange/{{$bigOrange->id}}'>{{$bigOrange->big_orange_name}}</a></li>
        <li class='active'>Edit</li>
        </ol>

        <h1>Edit BigOrange</h1>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/big-orange/'. $bigOrange->id) }}">
        <input type="hidden" name="_method" value="patch">
        {!! csrf_field() !!}

        <!-- big_orange_name Form Input -->
            <div class="form-group{{ $errors->has('big_orange_name') ? ' has-error' : '' }}">
                <label class="control-label">BigOrange Name</label>

                    <input type="text" class="form-control" name="big_orange_name" value="{{ $bigOrange->big_orange_name }}">

                    @if ($errors->has('big_orange_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('big_orange_name') }}</strong>
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