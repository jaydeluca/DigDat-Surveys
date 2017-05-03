@extends('layouts.app')

@section('content')
    <div class="section product-header">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <span class="title is-3">{{ $survey->name }}</span>
                    <span class="title is-3 has-text-muted">&nbsp;|&nbsp;</span>
                    <span class="title is-4 has-text-muted">Created {{ $survey->created_at }}</span>
                </div>
            </div>
        </div>
    </div>

    <survey></survey>
@endsection
