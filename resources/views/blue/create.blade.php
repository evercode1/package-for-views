@extends('layouts.master')

@section('title')

    <title>Create a Blue</title>

@endsection

@section('content')

        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/blue'>Blue</a></li><li class='active'>Create</li></ol>

        <h2>Create a New Blue</h2>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/blue') }}">

        {!! csrf_field() !!}

        <!-- blue_name Form Input -->
            <div class="form-group{{ $errors->has('blue_name') ? ' has-error' : '' }}">
                <label class="control-label">Blue Name</label>

                    <input type="text" class="form-control" name="blue_name" value="{{ old('blue_name') }}">

                    @if ($errors->has('blue_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('blue_name') }}</strong>
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