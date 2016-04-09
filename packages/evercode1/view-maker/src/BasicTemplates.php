<?php

namespace Evercode1\ViewMaker;


class BasicTemplates
{

    public $tokenBuilder;

    public function __construct()
    {
        $this->tokenBuilder = new CommonTemplates;

    }


    public function basicIndexTemplate($masterPage, $modelName, $folderName)
    {

        list($upperCaseModelName,
            $field_name,
            $modelId,
            $modelAttribute,
            $createdAt,
            $modelRoute,
            $tableName
            ) = $this->tokenBuilder->formatTokens($modelName, $folderName);

        $content = <<<EOD
@extends('layouts.$masterPage')

@section('title')

    <title>$upperCaseModelName</title>

@endsection

@section('content')

        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/$modelRoute'>$upperCaseModelName</a></li>
        </ol>

<h1>This is your $upperCaseModelName Index Page</h1>

@endsection
EOD;

        return $content;

    }




}
