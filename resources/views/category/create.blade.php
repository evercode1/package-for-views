@extends('layouts.master')

@section('title')

    <title>Create a Category</title>

@endsection

@section('content')

        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/category'>Category</a></li><li class='active'>Create</li></ol>

        <h2>Create a New Category</h2>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/category') }}">

        {!! csrf_field() !!}

        <!-- category_name Form Input -->
            <div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                <label class="control-label">Category Name</label>

                    <input type="text" class="form-control" name="category_name" value="{{ old('category_name') }}">

                    @if ($errors->has('category_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('category_name') }}</strong>
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