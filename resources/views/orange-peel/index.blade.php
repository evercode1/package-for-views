
@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('title')

    <title>The Orange-peel Page</title>

@endsection

@section('content')



        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/orange-peel'>Orange-peel</a></li>
        </ol>

        <h1>Orange-peel</h1>

        @include('orange-peel.datatable')

        <div> <a href="/orange-peel/create">
              <button type="button" class="btn btn-lg btn-primary">
                        Create New
              </button></a>
            </div>



@endsection

@section('scripts')

    @include('orange-peel.datatable-script')

@endsection