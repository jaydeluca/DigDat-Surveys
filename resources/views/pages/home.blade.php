@extends('layouts.app')

@section('content')
    <div class="section background-alternate">
        <div class="row">
            <div class="columns">
                <div class="column is-two-thirds">
                    <div class="card">
                        <div class="card-header background-accent">
                            <p class="card-header-title">User Info</p>
                        </div>
                        <div class="card-content">
                            <ul class="u-nice-list">
                                <li>
                                    <strong>Username:</strong>
                                    <span>{{ $user->name }}</span>
                                </li>
                                <li>
                                    <strong>Email:</strong>
                                    <span>{{ $user->email }}</span>
                                </li>
                                <li>
                                    <strong>Link slug:</strong>
                                    <a href="{{ $user->path() }}">{{ $user->path() }}</a>
                                </li>
                                <li>
                                    <strong>Member since:</strong>
                                    <span>{{$user->created_at}}</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
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
                                        <a href="{{ $survey->path() }}">
                                            {{ $survey->name }}
                                        </a>
                                        <span>
                                            {{ $survey->created_at }}
                                        </span>
                                        <a href="">
                                            Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ $survey->path() }}/results">
                                            Results ({{ $survey->submissions()->count() }})
                                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
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
                                        <span>
                                            {{ $survey->created_at }}
                                        </span>
                                        <span>
                                            {{ $survey->submissions()->count() }} Submissions
                                        </span>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{ route('all-public-surveys') }}">&raquo; view all</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
