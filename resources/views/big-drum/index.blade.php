
@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('title')

    <title>The BigDrum Page</title>

@endsection

@section('content')



        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/big-drum'>BigDrum</a></li>
        </ol>

        <h1>BigDrum</h1>

        @include('big-drum.datatable')

        <div> <a href="/big-drum/create">
              <button type="button" class="btn btn-lg btn-primary">
                        Create New
              </button></a>
            </div>



@endsection

@section('scripts')

    @include('big-drum.datatable-script')

@endsection