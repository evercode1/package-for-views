<?php

namespace Evercode1\ViewMaker;


class BasicTemplates
{

    public $commonBuilder;

    public function __construct()
    {
        $this->commonBuilder = new CommonTemplates;

    }

    public function buildBasicTemplate($filename, $masterPage, $modelName)
    {

        switch ($filename) {

            case 'create' :

                return $this->commonBuilder->commonCreateTemplate($masterPage, $modelName);

            case 'edit' :

                return $this->commonBuilder->commonEditTemplate($masterPage, $modelName);

            case 'show' :

                return $this->commonBuilder->commonShowTemplate($masterPage, $modelName);

            case 'index' :

                return $this->basicIndexTemplate($masterPage, $modelName);

            default:

                return 'filename not supported';

        }
    }


    public function basicIndexTemplate($masterPage, $modelName)
    {

        list($upperCaseModelName) = $this->commonBuilder->formatTokens($modelName);

        $content = <<<EOD
@extends('layouts.$masterPage')

@section('title')

    <title>$upperCaseModelName</title>

@endsection

@section('content')

        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/$modelName'>$upperCaseModelName</a></li>
        </ol>

<h1>This is your $upperCaseModelName Index Page</h1>

@endsection
EOD;

        return $content;

    }




}
