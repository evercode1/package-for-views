
@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('title')

    <title>The BlackHammer Page</title>

@endsection

@section('content')



        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/black-hammer'>BlackHammer</a></li>
        </ol>

        <h1>BlackHammer</h1>

        @include('black-hammer.datatable')

        <div> <a href="/black-hammer/create">
              <button type="button" class="btn btn-lg btn-primary">
                        Create New
              </button></a>
            </div>



@endsection

@section('scripts')

    @include('black-hammer.datatable-script')

@endsection