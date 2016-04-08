<?php

namespace Evercode1\ViewMaker;

class CommonTemplates
{

    public function commonCreateTemplate($masterPage, $modelName)
    {
        list($upperCaseModelName,
            $field_name) = $this->formatTokens($modelName);

        $content = <<<EOD
@extends('layouts.$masterPage')

@section('title')

    <title>Create a $upperCaseModelName</title>

@endsection

@section('content')

        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/$modelName'>$upperCaseModelName</a></li><li class='active'>Create</li></ol>

        <h2>Create a New $upperCaseModelName</h2>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/$modelName') }}">

        {!! csrf_field() !!}

        <!-- $field_name Form Input -->
            <div class="form-group{{ \$errors->has('$field_name') ? ' has-error' : '' }}">
                <label class="control-label">$upperCaseModelName Name</label>

                    <input type="text" class="form-control" name="$field_name" value="{{ old('$field_name') }}">

                    @if (\$errors->has('$field_name'))
                        <span class="help-block">
                                        <strong>{{ \$errors->first('$field_name') }}</strong>
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
EOD;


        return $content;

    }

    public function commonEditTemplate($masterPage, $modelName)
    {
        list($upperCaseModelName,
            $field_name,
            $modelId,
            $modelAttribute) = $this->formatTokens($modelName);

        $content = <<<EOD
@extends('layouts.$masterPage')

@section('title')

    <title>Edit $upperCaseModelName</title>

@endsection

@section('content')


        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/$modelName'>$upperCaseModelName</a></li><li><a href='/$modelName/{{\$$modelId}}'>{{\$$modelAttribute}}</a></li><li class='active'>Edit</li></ol>

        <h1>Edit $upperCaseModelName</h1>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/$modelName/'. \$$modelId) }}">
        <input type="hidden" name="_method" value="patch">
        {!! csrf_field() !!}

        <!-- $field_name Form Input -->
            <div class="form-group{{ \$errors->has('$field_name') ? ' has-error' : '' }}">
                <label class="control-label">$upperCaseModelName Name</label>

                    <input type="text" class="form-control" name="$field_name" value="{{ \$$modelAttribute }}">

                    @if (\$errors->has('$field_name'))
                        <span class="help-block">
                                        <strong>{{ \$errors->first('$field_name') }}</strong>
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
EOD;


        return $content;


    }

    public function commonShowTemplate($masterPage, $modelName)
    {
        $upperCaseModelName = ucfirst($modelName);
        //$field_name = $modelName . '_name';
        $modelId = $modelName . '->id';
        $modelAttribute = $modelName . '->' . $modelName . '_name';
        $createdAt = $modelName . '->created_at';


        $content = <<<EOD
@extends('layouts.$masterPage')

@section('title')

    <title>$upperCaseModelName</title>

@endsection

@section('content')

        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/$modelName'>$upperCaseModelName</a></li>
        <li><a href='/$modelName/{{ \$$modelId }}'>{{ \$$modelAttribute }}</a></li>
        </ol>

        <h1>$upperCaseModelName Details</h1>

        <hr/>

        <div class="panel panel-default">

                <!-- Table -->
                <table class="table table-striped">
                    <tr>

                        <th>Id</th>
                        <th>Name</th>
                        <th>Date Created</th>
                        <th>Edit</th>
                        <th>Delete</th>

                    </tr>


                    <tr>
                        <td>{{ \$$modelId }} </td>
                        <td> <a href="/$modelName/{{ \$$modelId }}/edit">
                                {{ \$$modelAttribute }}</a></td>
                        <td>{{ \$$createdAt }}</td>

                        <td> <a href="/widget/{{ \$$modelId }}/edit">

                                <button type="button" class="btn btn-default">Edit</button></a></td>

                        <td>

                        <div class="form-group">

                       <form class="form" role="form" method="POST" action="{{ url('/$modelName/'. \$$modelId) }}">
                       <input type="hidden" name="_method" value="delete">
                       {!! csrf_field() !!}

                       <input class="btn btn-danger" Onclick="return ConfirmDelete();" type="submit" value="Delete">

                            </form>
                       </div>
                       </td>

                    </tr>

                </table>


        </div>

@endsection
@section('scripts')
    <script>
        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endsection
EOD;

        return $content;

    }

    public function formatTokens($modelName)
    {
        $upperCaseModelName = ucfirst($modelName);
        $field_name = $modelName . '_name';
        $modelId = $modelName . '->id';
        $modelAttribute = $modelName . '->' . $modelName . '_name';
        $createdAt = $modelName . '->created_at';

        return [$upperCaseModelName, $field_name, $modelId, $modelAttribute, $createdAt];
    }

}