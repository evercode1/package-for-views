<?php

namespace Evercode1\ViewMaker;


class DatatableTemplates
{
    public $commonBuilder;

    public function __construct()
    {
        $this->commonBuilder = new CommonTemplates;

    }

    public function buildDtTemplate($filename, $masterPage, $modelName, $folderName)
    {



        switch ($filename) {

            case 'create' :

                return $this->commonBuilder->commonCreateTemplate($masterPage, $modelName, $folderName);

            case 'edit' :

                return $this->commonBuilder->commonEditTemplate($masterPage, $modelName, $folderName);

            case 'show' :

                return $this->commonBuilder->commonShowTemplate($masterPage, $modelName, $folderName);

            case 'index' :

                return $this->dtIndexTemplate($masterPage, $modelName , $folderName);

            case 'datatable' :

                return $this->dtDatatableTemplate($modelName, $folderName);

            case 'datatable-script' :

                return $this->dtDatatableScriptTemplate($modelName, $folderName);



            default:

                return 'filename not supported';

        }

    }


    public function dtIndexTemplate($masterPage, $modelName, $folderName)
    {
        list($upperCaseModelName,
             $field_name,
             $modelId,
             $modelAttribute,
             $createdAt,
             $modelRoute,
             $tableName
             ) = $this->commonBuilder->formatTokens($modelName, $folderName);

        $content = <<<EOD

@extends('layouts.$masterPage')

@section('title')

    <title>The $upperCaseModelName Page</title>

@endsection

@section('content')

    <div class="container">

        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/$modelRoute'>$upperCaseModelName</a></li>
        </ol>

        <h1>$upperCaseModelName</h1>

        @include('$folderName.datatable')

        <div> <a href="/$modelRoute/create">
              <button type="button" class="btn btn-lg btn-primary">
                        Create New
              </button></a>
            </div>

    </div>

@endsection

@section('scripts')

    @include('$folderName.datatable-script')

@endsection

EOD;


        return $content;

    }

    public function dtDatatableTemplate($modelName, $folderName)
    {
        list($upperCaseModelName,
            $field_name,
            $modelId,
            $modelAttribute,
            $createdAt,
            $modelRoute,
            $tableName
            ) = $this->commonBuilder->formatTokens($modelName, $folderName);

        $content = <<<EOD

    <table id="$tableName" class="display">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Date Created</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        </tbody>

    </table>
EOD;

        return $content;

    }

    public function dtDatatableScriptTemplate($modelName, $folderName)
    {

        list($upperCaseModelName,
            $field_name,
            $modelId,
            $modelAttribute,
            $createdAt,
            $modelRoute,
            $tableName
            ) = $this->commonBuilder->formatTokens($modelName, $folderName);

        $content = <<<EOD

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script>
    \$(document).ready( function () {
        \$('#$tableName').DataTable({
            select: false,
            "ajax": {
                "url": "/api/$modelRoute",
                "type": "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            "columns": [
                { "data": "id"},
                { "data": "$field_name",
                    "render": function(data,type,row,meta) {
                        return '<a href="/$modelRoute/'+row.id+'">'+data+'</a>';
                    }
                },
                { "data": "created_at",
                    "render": function ( data, type, full, meta ) {
                        // instantiate a moment object and hand it the string date
                        var d = moment(data);
                        var month = d.month() +1 < 10 ? "0" + (d.month() +1) : d.month() +1;
                        var day = d.date()  < 10 ? "0" + (d.date()): d.date();
                        return month + "/" + day + "/" + d.year();
                    }
                },
                {"defaultContent": "null", "render": function(data,type,row,meta) {
                    return '<a href="/$modelRoute/'+row.id+'/edit">'+ '<button>Edit</button>' + '</a>';
                }
                }
            ]
        });
    } );
</script>


EOD;


        return $content;

    }
}
