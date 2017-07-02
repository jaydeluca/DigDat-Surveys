@extends('layouts.app')

@section('content')

    <div class="container results">

        <div class="results--header">
            <p class="title" style="display: flex; justify-content: space-between;">
                <span>
                    Results for <strong>{{ $survey->name }}</strong>
                </span>
                <span class="tag is-dark">{{ $submissions }} Submissions</span>
            </p>
        </div>

        <div class="questions">
            @foreach ($questions as $question)
                <div class="column question card" style="margin: 10px;">
                    <blockquote>
                        <p class="question-text">{{ $question->question }}</p>
                    </blockquote>
                    <div class="columns answers">
                        @foreach ($question->options as $option)
                            <div class="column option">
                                <span>{{ $option["option"] }}</span>
                                <strong>{{ $option["count"] }}</strong>
                                <percentage count="{{ $option["count"] }}" total="{{ $question->total }}"></percentage>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection
