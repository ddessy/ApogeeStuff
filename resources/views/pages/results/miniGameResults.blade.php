@extends('layouts.app')

@section('title', 'View Results')

@section('content')

    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

    <div style="margin-bottom: 30px">
        <h2>Results for mini-game: <span style="color: dodgerblue">WHO IS VALCHAN VOIVODA</span></h2>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{$result->total_playing_time}}</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('addCss')
    @parent

    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection


@section('addJs')
    @parent
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/pages/results/index.js"></script>
@endsection
