<?php

namespace Evercode1\ViewMaker;


class PlainTemplates
{

    public $tokens;

    public function __construct(array $tokens)
    {

        $this->tokens = new FormatsTokens($tokens);

    }

    public function plainIndexTemplate()
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

<h1>This is your $upperCaseModelName Index Page</h1>

@endsection
EOD;

        return $content;

    }

    public function plainCreateTemplate()
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

<h1>This is your $upperCaseModelName Create Page</h1>

@endsection
EOD;

        return $content;

    }

    public function plainShowTemplate()
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

<h1>This is your $upperCaseModelName Show Page</h1>

@endsection
EOD;

        return $content;

    }

    public function plainEditTemplate()
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

<h1>This is your $upperCaseModelName Edit Page</h1>

@endsection
EOD;

        return $content;

    }



}