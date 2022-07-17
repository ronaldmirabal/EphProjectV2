@extends('layouts.app')

@section('template_title')
    Update Type People
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Type People</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('type-people.update', $typePeople->id) }}">
                            @csrf
                            @method('PUT')
                            @include('type-people.form')
                           

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
