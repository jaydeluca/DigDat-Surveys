@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Survey</th>
                            <th>Questions</th>
                            <th>Submissions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($surveys as $survey)
                            <tr>
                                <td>
                                    <a href="/results/{{ $survey->id }}">
                                        {{ $survey->name }}
                                    </a>
                                </td>
                                <td>{{ count($survey->questions) }}</td>
                                <td>{{ count($survey->submissions) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
