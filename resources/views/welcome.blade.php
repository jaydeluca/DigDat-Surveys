@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Latest Surveys</div>
                    <div class="panel-body">
                        <ul>
                            @foreach ($surveys as $survey)
                                <li>
                                    <a href="/survey/{{ $survey->id }}">
                                        {{ $survey->name }} Submissions: {{ count($survey->submissions) }}
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
