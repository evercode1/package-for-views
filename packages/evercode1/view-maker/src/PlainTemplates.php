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

        $content = <<<EOD
@extends('layouts.:::masterPage:::')

@section('title')

    <title>:::upperCaseModelName:::</title>

@endsection

@section('content')

<h1>This is your :::upperCaseModelName::: Index page</h1>

@endsection
EOD;

        return $this->tokens->formatTokens($content);

    }

    public function plainCreateTemplate()
    {


        $content = <<<EOD
@extends('layouts.:::masterPage:::')

@section('title')

    <title>:::upperCaseModelName:::</title>

@endsection

@section('content')

<h1>This is your :::upperCaseModelName::: Create page</h1>

@endsection
EOD;

        return $this->tokens->formatTokens($content);

    }

    public function plainShowTemplate()
    {

        $content = <<<EOD
@extends('layouts.:::masterPage:::')

@section('title')

    <title>:::upperCaseModelName:::</title>

@endsection

@section('content')

<h1>This is your :::upperCaseModelName::: Show page</h1>

@endsection
EOD;

        return $this->tokens->formatTokens($content);

    }

    public function plainEditTemplate()
    {

        $content = <<<EOD
@extends('layouts.:::masterPage:::')

@section('title')

    <title>:::upperCaseModelName:::</title>

@endsection

@section('content')

<h1>This is your :::upperCaseModelName::: Edit page</h1>

@endsection
EOD;

        return $this->tokens->formatTokens($content);

    }



}