@extends('layouts.app')

@section('content')

    <section class="hero is-fullheight is-dark is-bold">
        <div class="hero-body">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <p class="card-header-title">Surveys</p>
                    </div>
                    <div class="card-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Questions</th>
                                <th>Submissions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($surveys as $survey)
                                <tr>
                                    <td>
                                        <a href="/surveys/{{ $survey->id }}">
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
    </section>

@endsection
