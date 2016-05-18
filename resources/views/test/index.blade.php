@extends('layouts.master')

@section('title')

    <title>Test</title>

@endsection

@section('content')

<h1>This is your Test Index page</h1>

    {{ $output }}

    <br>

    {{ $count }}

@endsection