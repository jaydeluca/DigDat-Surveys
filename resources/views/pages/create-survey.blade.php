@extends('layouts.app')

@section('content')

    <section class="hero is-fullheight is-dark is-bold">
        <div class="hero-body">
            <div class="container">
                <div class="columns">
                    <div class="column is-8 is-offset-2">
                        <span class="title is-2">Create Survey</span>
                    </div>
                </div>

                <div class="columns">
                    <div class="column is-8 is-offset-2">
                        <div class="box">
                            <div class="field">
                                <label class="label">Name</label>
                                <p class="control">
                                    <input class="input" type="text" placeholder="Ex. Patriots Fan Survey">
                                </p>
                            </div>
                            <div class="field">
                                <p class="control">
                                    <textarea class="textarea" placeholder="Description (optional)"></textarea>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
