@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="columns">
            <div class="column">
                <div class="card is-one-third">
                    <div class="card-header">
                        <p class="card-header-title">Your Surveys</p>
                    </div>
                    <div class="card-content">
                        <ul>
                            @foreach ($user_surveys as $survey)
                                <li>{{ $survey->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="card is-one-third">
                    <div class="card-header">
                        <p class="card-header-title">Latest Surveys</p>
                    </div>
                    <div class="card-content">
                        <ul>
                            @foreach ($latest_surveys as $survey)
                                <li>{{ $survey->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
