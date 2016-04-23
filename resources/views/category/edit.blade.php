@extends('layouts.master')

@section('title')

    <title>Edit Category</title>

@endsection

@section('content')


        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/category'>Category</a></li>
        <li><a href='/category/{{$category->id}}'>{{$category->category_name}}</a></li>
        <li class='active'>Edit</li>
        </ol>

        <h1>Edit Category</h1>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/category/'. $category->id) }}">
        <input type="hidden" name="_method" value="patch">
        {!! csrf_field() !!}

        <!-- category_name Form Input -->
            <div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                <label class="control-label">Category Name</label>

                    <input type="text" class="form-control" name="category_name" value="{{ $category->category_name }}">

                    @if ($errors->has('category_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('category_name') }}</strong>
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