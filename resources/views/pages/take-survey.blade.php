@extends('layouts.app')

@section('content')

    <section class="hero">
        <div class="hero-body" style="flex-direction: column;">
            <div class="container">
                <div clas="columns">
                    <div class="column is-fullwidth">
                        <span class="title is-2">{{ $survey->name }}</span>
                        <span class="title is-3 has-text-muted">&nbsp;|&nbsp;</span>
                        <span class="title is-4 has-text-muted">Created {{ $survey->created_at }}</span>
                    </div>
                </div>
                <div clas="columns">
                    <div class="column is-fullwidth">
                        <survey></survey>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
