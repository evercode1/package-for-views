@extends('layouts.master')

@section('title')

    <title>Create a BigOrange</title>

@endsection

@section('content')

        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/big-orange'>BigOrange</a></li><li class='active'>Create</li></ol>

        <h2>Create a New BigOrange</h2>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/big-orange') }}">

        {!! csrf_field() !!}

        <!-- big_orange_name Form Input -->
            <div class="form-group{{ $errors->has('big_orange_name') ? ' has-error' : '' }}">
                <label class="control-label">BigOrange Name</label>

                    <input type="text" class="form-control" name="big_orange_name" value="{{ old('big_orange_name') }}">

                    @if ($errors->has('big_orange_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('big_orange_name') }}</strong>
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