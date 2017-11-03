@extends('layouts.app')

@section('content')

    <section class="hero background-alternate">
        <div class="hero-body">
            <div class="container">
                <div class="card">
                    <div class="card-header background-accent">
                        <p class="card-header-title">
                        @if($owner)
                            Active Surveys by {{$owner->name}}
                        @else
                            All Active Surveys
                        @endif
                        </p>
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
                                @if (!$surveys->count())
                                <tr>
                                    <td>No Active surveys</td>
                                </tr>
                            @else
                                @foreach ($surveys as $survey)
                                    <tr>
                                        <td>
                                            <a href="{{ $survey->path() }}">
                                                {{ $survey->name }}
                                            </a>
                                        </td>
                                        <td>{{ $survey->questions->count() }}</td>
                                        <td>{{ $survey->submissions->count() }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
