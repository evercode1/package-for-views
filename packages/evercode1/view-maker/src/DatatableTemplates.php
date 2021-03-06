<?php

namespace Evercode1\ViewMaker;


class DatatableTemplates
{
    public $tokens;

    public function __construct(array $tokens)
    {

        $this->tokens = new FormatsTokens($tokens);

    }


    public function dtIndexTemplate()
    {

        $content = <<<EOD

@extends('layouts.:::masterPage:::')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('title')

    <title>The :::modelsUpperCase::: Page</title>

@endsection

@section('content')



        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href=':::modelRoute:::'>:::modelsUpperCase:::</a></li>
        </ol>

        <h1>:::modelsUpperCase:::</h1>

        @include(':::folderName:::.datatable')

        <div> <a href=":::modelRoute:::/create">
              <button type="button" class="btn btn-lg btn-primary">
                        Create New
              </button></a>
            </div>



@endsection

@section('scripts')

    @include(':::folderName:::.datatable-script')

@endsection
EOD;


        return $this->tokens->formatTokens($content);

    }

    public function dtDatatableTemplate()
    {

        $content = <<<EOD

    <table id=":::dtTableName:::" class="display">
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

        return $this->tokens->formatTokens($content);

    }

    public function dtDatatableSlugTemplate()
    {

        $content = <<<EOD

    <table id=":::dtTableName:::" class="display">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Date Created</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        </tbody>

    </table>
EOD;

        return $this->tokens->formatTokens($content);

    }

    public function dtChildDatatableTemplate()
    {

        $content = <<<EOD

    <table id=":::dtTableName:::" class="display">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>:::parent:::</th>
            <th>Date Created</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        </tbody>

    </table>
EOD;

        return $this->tokens->formatTokens($content);

    }

    public function dtChildDatatableSlugTemplate()
    {

        $content = <<<EOD

    <table id=":::dtTableName:::" class="display">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>:::parent:::</th>
            <th>Slug</th>
            <th>Date Created</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        </tbody>

    </table>
EOD;

        return $this->tokens->formatTokens($content);

    }

    public function dtDatatableScriptTemplate()
{

    $content = <<<EOD
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script>
    \$(document).ready( function () {
        \$('#:::dtTableName:::').DataTable({
            select: false,
            "ajax": {
                "url": "/api:::modelRoute:::",
                "type": "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            "columns": [
                { "data": "Id"},
                { "data": "Name",
                    "render": function(data,type,row,meta) {
                        return '<a href=":::modelRoute:::/'+row.Id+'">'+data+'</a>';
                    }
                },
                { "data": "Created",
                    "render": function ( data, type, full, meta ) {
                        // instantiate a moment object and hand it the string date
                        var d = moment(data);
                        var month = d.month() +1 < 10 ? "0" + (d.month() +1) : d.month() +1;
                        var day = d.date()  < 10 ? "0" + (d.date()): d.date();
                        return month + "/" + day + "/" + d.year();
                    }
                },
                {"defaultContent": "null", "render": function(data,type,row,meta) {
                    return '<a href=":::modelRoute:::/'+row.Id+'/edit">'+ '<button>Edit</button>' + '</a>';
                }
                }
            ]
        });
    } );
</script>
EOD;


    return $this->tokens->formatTokens($content);

}

    public function dtDatatableScriptSlugTemplate()
    {

        $content = <<<EOD
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script>
    \$(document).ready( function () {
        \$('#:::dtTableName:::').DataTable({
            select: false,
            "ajax": {
                "url": "/api:::modelRoute:::",
                "type": "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            "columns": [
                { "data": "Id"},
                { "data": "Name",
                    "render": function(data,type,row,meta) {
                        return '<a href=":::modelRoute:::/'+row.Id+'-'+row.Slug+'">'+data+'</a>';
                    }
                },
                { "data": "Slug", "visible": false},
                { "data": "Created",
                    "render": function ( data, type, full, meta ) {
                        // instantiate a moment object and hand it the string date
                        var d = moment(data);
                        var month = d.month() +1 < 10 ? "0" + (d.month() +1) : d.month() +1;
                        var day = d.date()  < 10 ? "0" + (d.date()): d.date();
                        return month + "/" + day + "/" + d.year();
                    }
                },
                {"defaultContent": "null", "render": function(data,type,row,meta) {
                    return '<a href=":::modelRoute:::/'+row.Id+'/edit">'+ '<button>Edit</button>' + '</a>';
                }
                }
            ]
        });
    } );
</script>
EOD;


        return $this->tokens->formatTokens($content);

    }

    public function dtChildDatatableScriptTemplate()
    {

        $content = <<<EOD
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script>
    \$(document).ready( function () {
        \$('#:::dtTableName:::').DataTable({
            select: false,
            "ajax": {
                "url": "/api:::modelRoute:::",
                "type": "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            "columns": [
                { "data": "Id"},
                { "data": "Name",
                    "render": function(data,type,row,meta) {
                        return '<a href=":::modelRoute:::/'+row.Id+'">'+data+'</a>';
                    }
                },
                { "data": ":::parent:::"},
                { "data": "Created",
                    "render": function ( data, type, full, meta ) {
                        // instantiate a moment object and hand it the string date
                        var d = moment(data);
                        var month = d.month() +1 < 10 ? "0" + (d.month() +1) : d.month() +1;
                        var day = d.date()  < 10 ? "0" + (d.date()): d.date();
                        return month + "/" + day + "/" + d.year();
                    }
                },
                {"defaultContent": "null", "render": function(data,type,row,meta) {
                    return '<a href=":::modelRoute:::/'+row.Id+'/edit">'+ '<button>Edit</button>' + '</a>';
                }
                }
            ]
        });
    } );
</script>
EOD;


        return $this->tokens->formatTokens($content);

    }

    public function dtChildDatatableScriptSlugTemplate()
    {

        $content = <<<EOD
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script>
    \$(document).ready( function () {
        \$('#:::dtTableName:::').DataTable({
            select: false,
            "ajax": {
                "url": "/api:::modelRoute:::",
                "type": "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            "columns": [
                { "data": "Id"},
                { "data": "Name",
                    "render": function(data,type,row,meta) {
                        return '<a href=":::modelRoute:::/'+row.Id+'-'+row.Slug+'">'+data+'</a>';
                    }
                },
                { "data": "Slug", "visible": false},
                { "data": ":::parent:::"},

                { "data": "Created",
                    "render": function ( data, type, full, meta ) {
                        // instantiate a moment object and hand it the string date
                        var d = moment(data);
                        var month = d.month() +1 < 10 ? "0" + (d.month() +1) : d.month() +1;
                        var day = d.date()  < 10 ? "0" + (d.date()): d.date();
                        return month + "/" + day + "/" + d.year();
                    }
                },
                {"defaultContent": "null", "render": function(data,type,row,meta) {
                    return '<a href=":::modelRoute:::/'+row.Id+'/edit">'+ '<button>Edit</button>' + '</a>';
                }
                }
            ]
        });
    } );
</script>
EOD;


        return $this->tokens->formatTokens($content);

    }
}
