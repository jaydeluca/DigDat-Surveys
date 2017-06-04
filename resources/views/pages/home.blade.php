@extends('layouts.app')

@section('content')
    <div class="section background-alternate">
        <div class="columns">
            <div class="column">
                <div class="card is-one-third">
                    <div class="card-header background-accent">
                        <p class="card-header-title">Your Surveys</p>
                    </div>
                    <div class="card-content">
                        <ul class="u-nice-list">
                            @foreach ($user_surveys as $survey)
                                <li>
                                    <a href="/results/{{ $survey->id }}">
                                        {{ $survey->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="card is-one-third">
                    <div class="card-header background-accent">
                        <p class="card-header-title">Latest Surveys</p>
                    </div>
                    <div class="card-content">
                        <ul class="u-nice-list">
                            @foreach ($latest_surveys as $survey)
                                <li>
                                    <a href="{{ $survey->path() }}">
                                        {{ $survey->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
