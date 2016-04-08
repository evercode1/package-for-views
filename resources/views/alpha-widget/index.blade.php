
@extends('layouts.master')

@section('title')

    <title>The AlphaWidget Page</title>

@endsection

@section('content')

    <div class="container">

        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/alpha-widget'>AlphaWidget</a></li>
        </ol>

        <h1>AlphaWidget</h1>

        @include('alpha-widget.datatable')

        <div> <a href="/alpha-widget/create">
              <button type="button" class="btn btn-lg btn-primary">
                        Create New
              </button></a>
            </div>

    </div>

@endsection

@section('scripts')

    @include('alpha-widget.datatable-script')

@endsection
