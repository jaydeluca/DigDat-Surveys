@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="">
            <div class="boards">
                <div class="columns">

                    <!-- Boards -->
                    @component('../components.board')
                        @slot('title')
                            Take Surveys
                        @endslot
                        @slot('heading')
                            Browse user created surveys
                        @endslot
                        @slot('subheading')
                            Latest Surveys:
                        @endslot
                        @slot('content')
                            <ul>
                                @foreach ($surveys as $survey)
                                    <li>
                                        <a href="/surveys/{{ $survey->id }}">
                                            {{ $survey->name }}
                                        </a>
                                        ({{ count($survey->questions) }} questions)</li>
                                @endforeach
                            </ul>
                        @endslot
                        @slot('coa')
                            <a class="button is-outlined is-fullwidth is-primary" href="/surveys">
                                Browse Surveys
                            </a>
                        @endslot
                    @endcomponent

                    @component('../components.board')
                        @slot('title')
                            Create Surveys
                        @endslot
                        @slot('heading')
                            Create an account and create a survey of your own
                        @endslot
                        @slot('subheading')
                            Features:
                        @endslot
                        @slot('content')
                            <ul>
                                <li>Analytics</li>
                                <li>Email Reports</li>
                                <li>Data Visualization</li>
                            </ul>
                        @endslot
                        @slot('coa')
                            <a class="button is-outlined is-fullwidth is-primary" href="/register">
                                Register
                            </a>
                        @endslot
                    @endcomponent

                </div>
            </div>
        </div>
    </div>
@endsection
