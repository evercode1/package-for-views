@extends('layouts.master')

@section('title')

    <title>Create a LittleRed</title>

@endsection

@section('content')

        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/little-red'>LittleRed</a></li><li class='active'>Create</li></ol>

        <h2>Create a New LittleRed</h2>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/little-red') }}">

        {!! csrf_field() !!}

        <!-- little_red_name Form Input -->
            <div class="form-group{{ $errors->has('little_red_name') ? ' has-error' : '' }}">
                <label class="control-label">LittleRed Name</label>

                    <input type="text" class="form-control" name="little_red_name" value="{{ old('little_red_name') }}">

                    @if ($errors->has('little_red_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('little_red_name') }}</strong>
                                    </span>
                    @endif

            </div>

            <div class="form-group{{ $errors->has('blue_id') ? ' has-error' : '' }}">

   <label for="blue_id">Blue Name:</label>
   <select class="form-control" name="blue_id">

   <option value="">Please Choose One</option>

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
                        Create
                    </button>
            </div>

        </form>

@endsection