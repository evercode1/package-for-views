@extends('layouts.master')

@section('title')

    <title>Create a Gadget</title>

@endsection

@section('content')

        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/gadget'>Gadget</a></li><li class='active'>Create</li></ol>

        <h2>Create a New Gadget</h2>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/gadget') }}">

        {!! csrf_field() !!}

        <!-- gadget_name Form Input -->
            <div class="form-group{{ $errors->has('gadget_name') ? ' has-error' : '' }}">
                <label class="control-label">Gadget Name</label>

                    <input type="text" class="form-control" name="gadget_name" value="{{ old('gadget_name') }}">

                    @if ($errors->has('gadget_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('gadget_name') }}</strong>
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