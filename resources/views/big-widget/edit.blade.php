@extends('layouts.master')

@section('title')

    <title>Edit BigWidget</title>

@endsection

@section('content')


        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/big-widget'>BigWidget</a></li>
        <li><a href='/big-widget/{{$bigWidget->id}}'>{{$bigWidget->big_widget_name}}</a></li>
        <li class='active'>Edit</li>
        </ol>

        <h1>Edit BigWidget</h1>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/big-widget/'. $bigWidget->id) }}">
        <input type="hidden" name="_method" value="patch">
        {!! csrf_field() !!}

        <!-- big_widget_name Form Input -->
            <div class="form-group{{ $errors->has('big_widget_name') ? ' has-error' : '' }}">
                <label class="control-label">BigWidget Name</label>

                    <input type="text" class="form-control" name="big_widget_name" value="{{ $bigWidget->big_widget_name }}">

                    @if ($errors->has('big_widget_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('big_widget_name') }}</strong>
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