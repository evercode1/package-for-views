<?php

namespace Evercode1\ViewMaker;


class BasicTemplates
{

    public $tokens;

    public function __construct(array $tokens)
    {

        $this->tokens = new FormatsTokens($tokens);

    }


    public function basicIndexTemplate()
    {

        list($upperCaseModelName,
            $field_name,
            $modelId,
            $modelAttribute,
            $createdAt,
            $modelRoute,
            $tableName,
            $masterPage,
            $modelName,
            $folderName
            ) = $this->tokens->formatTokens();

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
