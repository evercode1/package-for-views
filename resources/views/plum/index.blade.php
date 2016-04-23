
@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('title')

    <title>The Plum Page</title>

@endsection

@section('content')



        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/plum'>Plum</a></li>
        </ol>

        <h1>Plum</h1>

        @include('plum.datatable')

        <div> <a href="/plum/create">
              <button type="button" class="btn btn-lg btn-primary">
                        Create New
              </button></a>
            </div>



@endsection

@section('scripts')

    @include('plum.datatable-script')

@endsection