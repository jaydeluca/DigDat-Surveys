@extends('layouts.app')

@section('content')

    <section class="home is-active">
        <div class="bg">
            <div class="copy">
                <h1>Create. Collect. Customize.</h1>
                <p>DigDat provides the ability to create surveys, customize the data you collect, and export your
                    results for presentations or fun.<br><br>
                    And it's free.
                </p>
            </div>
        </div>
    </section>

    <section class="cta background-white">

        <a href="{{ route('create-survey') }}" class="button c-btn c-btn--primary c-btn--lg">Create a Survey</a>
        <a href="{{ route('all-public-surveys') }}" class="button c-btn c-btn--primary c-btn--lg">Browse Surveys</a>

    </section>

    <section class="cta-2">

        DigDat Surveys is an open source survey platform project. It is currently under construction and only semi-functional at the moment.


    </section>

    {{--<section class="hero is-dark is-bold">--}}
        {{--<div class="hero-body">--}}
            {{--<div class="container">--}}
                {{--<div class="boards">--}}
                    {{--<div class="columns">--}}

                        {{--<!-- Boards -->--}}
                        {{--@component('../components.board')--}}
                            {{--@slot('title')--}}
                                {{--Take Surveys--}}
                            {{--@endslot--}}
                            {{--@slot('heading')--}}
                                {{--Browse user created surveys--}}
                            {{--@endslot--}}
                            {{--@slot('subheading')--}}
                                {{--Latest Surveys:--}}
                            {{--@endslot--}}
                            {{--@slot('content')--}}
                                {{--<ul>--}}
                                    {{--@foreach ($surveys as $survey)--}}
                                        {{--<li>--}}
                                            {{--<a href="/surveys/{{ $survey->id }}">--}}
                                                {{--{{ $survey->name }}--}}
                                            {{--</a>--}}
                                            {{--({{ count($survey->questions) }} questions)</li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                            {{--@endslot--}}
                            {{--@slot('coa')--}}
                                {{--<a class="button is-outlined is-fullwidth is-primary" href="/surveys">--}}
                                    {{--Browse Surveys--}}
                                {{--</a>--}}
                            {{--@endslot--}}
                        {{--@endcomponent--}}

                        {{--@component('../components.board')--}}
                            {{--@slot('title')--}}
                                {{--Create Surveys--}}
                            {{--@endslot--}}
                            {{--@slot('heading')--}}
                                {{--Create an account and create a survey of your own--}}
                            {{--@endslot--}}
                            {{--@slot('subheading')--}}
                                {{--Features:--}}
                            {{--@endslot--}}
                            {{--@slot('content')--}}
                                {{--<ul>--}}
                                    {{--<li>Analytics</li>--}}
                                    {{--<li>Email Reports</li>--}}
                                    {{--<li>Data Visualization</li>--}}
                                {{--</ul>--}}
                            {{--@endslot--}}
                            {{--@slot('coa')--}}
                                {{--<a class="button is-outlined is-fullwidth is-primary" href="/register">--}}
                                    {{--Register--}}
                                {{--</a>--}}
                            {{--@endslot--}}
                        {{--@endcomponent--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
@endsection
