
@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('title')

    <title>The Category Page</title>

@endsection

@section('content')



        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/category'>Category</a></li>
        </ol>

        <h1>Category</h1>

        @include('category.datatable')

        <div> <a href="/category/create">
              <button type="button" class="btn btn-lg btn-primary">
                        Create New
              </button></a>
            </div>



@endsection

@section('scripts')

    @include('category.datatable-script')

@endsection