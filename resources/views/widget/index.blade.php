
@extends('layouts.master')

@section('title')

    <title>The Widget Page</title>

@endsection

@section('content')

    <div class="container">

        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/widget'>Widget</a></li>
        </ol>

        <h1>Widget</h1>

        @include('widget.datatable')

        <div> <a href="/widget/create">
              <button type="button" class="btn btn-lg btn-primary">
                        Create New
              </button></a>
            </div>

    </div>

@endsection

@section('scripts')

    @include('widget.datatable-script')

@endsection
