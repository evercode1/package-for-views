@extends('layouts.master')

@section('title')

    <title>BlackHammer</title>

@endsection

@section('content')

        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/black-hammer'>BlackHammer</a></li>
        <li><a href='/black-hammer/{{ $blackHammer->id }}'>{{ $blackHammer->black_hammer_name }}</a></li>
        </ol>

        <h1>BlackHammer Details</h1>

        <hr/>

        <div class="panel panel-default">

                <!-- Table -->
                <table class="table table-striped">
                    <tr>

                        <th>Id</th>
                        <th>Name</th>
                        <th>Date Created</th>
                        <th>Edit</th>
                        <th>Delete</th>

                    </tr>


                    <tr>
                        <td>{{ $blackHammer->id }} </td>
                        <td> <a href="/black-hammer/{{ $blackHammer->id }}/edit">
                                {{ $blackHammer->black_hammer_name }}</a></td>
                        <td>{{ $blackHammer->created_at }}</td>

                        <td> <a href="/black-hammer/{{ $blackHammer->id }}/edit">

                                <button type="button" class="btn btn-default">Edit</button></a></td>

                        <td>

                        <div class="form-group">

                       <form class="form" role="form" method="POST" action="{{ url('/black-hammer/'. $blackHammer->id) }}">
                       <input type="hidden" name="_method" value="delete">
                       {!! csrf_field() !!}

                       <input class="btn btn-danger" Onclick="return ConfirmDelete();" type="submit" value="Delete">

                            </form>
                       </div>
                       </td>

                    </tr>

                </table>


        </div>

@endsection
@section('scripts')
    <script>
        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endsection