<?php

namespace Evercode1\ViewMaker;


class BasicTemplates
{

    public $commonBuilder;

    public function __construct()
    {
        $this->commonBuilder = new CommonTemplates;

    }

    public function buildBasicTemplate($filename, $masterPage, $modelName, $folderName)
    {

        switch ($filename) {

            case 'create' :

                return $this->commonBuilder->commonCreateTemplate($masterPage, $modelName, $folderName);

            case 'edit' :

                return $this->commonBuilder->commonEditTemplate($masterPage, $modelName, $folderName);

            case 'show' :

                return $this->commonBuilder->commonShowTemplate($masterPage, $modelName, $folderName);

            case 'index' :

                return $this->basicIndexTemplate($masterPage, $modelName, $folderName);

            default:

                return 'filename not supported';

        }
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
            ) = $this->commonBuilder->formatTokens($modelName, $folderName);

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
