@extends('layouts.master')

@section('title')

    <title>Edit Gadget</title>

@endsection

@section('content')


        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/gadget'>Gadget</a></li>
        <li><a href='/gadget/{{$gadget->id}}'>{{$gadget->gadget_name}}</a></li>
        <li class='active'>Edit</li>
        </ol>

        <h1>Edit Gadget</h1>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/gadget/'. $gadget->id) }}">
        <input type="hidden" name="_method" value="patch">
        {!! csrf_field() !!}

        <!-- gadget_name Form Input -->
            <div class="form-group{{ $errors->has('gadget_name') ? ' has-error' : '' }}">
                <label class="control-label">Gadget Name</label>

                    <input type="text" class="form-control" name="gadget_name" value="{{ $gadget->gadget_name }}">

                    @if ($errors->has('gadget_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('gadget_name') }}</strong>
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